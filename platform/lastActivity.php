<script src="js/jquery-3.5.0.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/collapsibleSideBar.js"></script>
<script src="js/jquery-ui.min.js"></script>
<!--ALL JS SCRIPTS -->
<div id="chatListModal"></div> <!-- MODAL FOR CHATLIST -->
<div id="chatBoxModal"></div> <!-- MODAL FOR CHATBOX -->
<?php
include 'css.php';
?>
<script type="text/javascript">
    //display chat box stuff
    $(document).ready(function(){
//============================================================== CHAT BOX STUFF =================================================/

        function makeChatDialogBox(to_user_id, to_user_name)
        {
            var modal_content = '<div id="user_dialog_'+to_user_id+'" class="user_dialog" title="You have chat with '+to_user_name+'">';
            modal_content += '<div style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'">';
            modal_content += '</div>';
            modal_content += '<div class="form-group">';
            modal_content += '<textarea name="chat_message_'+to_user_id+'" id="chat_message_'+to_user_id+'" class="form-control"></textarea>';
            modal_content += '</div><div class="form-group" align="right">';
            modal_content+= '<button type="button" name="send_chat" id="'+to_user_id+'" class="btn btn-info send_chat">Send</button></div></div>';
            $('#chatBoxModal').html(modal_content);
        }

        $(document).on('click', '.send_chat', function(){
            var to_user_id = $(this).attr('id');
            var chat_message = $('#chat_message_'+to_user_id).val();
            $.ajax({
                url:"ajax/insertChat.php",
                method:"POST",
                data:{to_user_id:to_user_id, chat_message:chat_message},
                success:function(data)
                {
                    $('#chat_message_'+to_user_id).val('');
                    if(data != "inserted"){
                        // console.log(data);
                    }else{
                        update_chat_history_data();
                    }

                }
            })
        });

        //chat messages functions
        function update_chat_history_data()
        {
            $('.chat_history').each(function(){
                var to_user_id = $(this).data('touserid');
                fetchUserChatHistory(to_user_id);
            });
        }

        function fetchUserChatHistory(to_user_id)
        {
            $.ajax({
                url:"ajax/fetchUserChatHistory.php",
                method:"POST",
                data:{to_user_id:to_user_id},
                success:function(data){
                    console.log(data);
                    $('#chat_history_'+to_user_id).html(data);
                }
            })
        }

//============================================================== =================================================/

//==============================================================DISPLAY ONLINE OFFLINE CHATS =================================================/
        //onclick Open chat list
        $(document).on('click', '.onlineButton', function(){
            makeChatList();
            $("#chatListModal").dialog({
                autoOpen:false,
                width:400,
                title: "Chat List"
            });
            $("#chatListModal").dialog('open');
        });

        function makeChatList()
        {
            var modal_content = '<div id= "chatListContent" class="user_dialog">';
            modal_content += '<input class="form-control" id="searchName" name="searchName" type="text" placeholder="Search..">';
            modal_content += ' <div class="" style="max-height:100%;  margin-top: 50px; margin-bottom:50px;" >';
            modal_content += '<div class="chatListModalBody">';
            modal_content += '</div>';
            modal_content += '</div>';
            modal_content += '</div>';
            $('#chatListModal').html(modal_content);
        }
        $(document).on('input', '#searchName', function() {
            // Does some stuff and logs the event to the console
            var searchName = $(this).val();
            fetch_user(searchName);
        });

        //updating last activity and retrieving it stuff.
        //Updates user activity every 5 seconds.
        function fetch_user(searchName)
        {
            $.post("ajax/fetchOnline.php",
                {
                    searchName: searchName
                },function(result){

                    var result = $.parseJSON(result);
                    $('#onlineButton').html("Chat (" + result.length + " Online)");
                    var onlineUserStrings = displayOnlineUsers(result);
                    fetch_user_offline(onlineUserStrings, searchName);
                });
        }

        function fetch_user_offline(onlineUserStrings, searchName)
        {
            $.post("ajax/fetchOffline.php",
                {
                    searchName: searchName
                },function(result){
                    var result = $.parseJSON(result);
                    displayOfflineUsers(result, onlineUserStrings)
                });
        }

        function displayOnlineUsers(onlineUsers){
            var string = "";
            string += '<div class="modal-header"> <h3 class="modal-title">Online Users</h3></div>';
            string += '<div class="modal-body">';
            for(var i = 1; i <= onlineUsers.length; i++){
                string += "<div class='row'>";
                string += "<div class='col-lg-9' style='margin-top: 3px'>Name: " + onlineUsers[i-1].username + " </div>";
                string += "<div class='col-lg-3'><button data-touserid='"+ onlineUsers[i-1].id + "' data-tousername='"+ onlineUsers[i-1].username + "' class='btn-all chatButton'>chat</button></div>";
                string += "</div><hr>";
            }
            string += '</div>';
            return string;
        }

        function displayOfflineUsers(offlineUsers, onlineUserStrings){
            var string = "";
            string += onlineUserStrings;
            string += '<div class="modal-header">\n' +
                '                <h3 class="modal-title">Offline Users</h3>\n' +
                '            </div>';
            string += '<div class="modal-body">';
            for(var i = 1; i <= offlineUsers.length; i++){
                string += "<div class='row'>";
                string += "<div class='col-lg-9' style='margin-top: 3px'>Name: " + offlineUsers[i-1].username + " </div>";
                string += "<div class='col-lg-3' style='margin-top: 3px'><button data-touserid='"+ offlineUsers[i-1].id + "' data-tousername='"+ offlineUsers[i-1].username + "' class='btn-all chatButton'>chat</button></div>";
                string += "</div><hr>";
            }
            string += '</div>';
            $('.chatListModalBody').html(string);
        }

        $(document).on('click', '.chatButton', function(){
            $('#chatListModal').modal('hide');
            var to_user_id = $(this).data('touserid');
            var to_user_name = $(this).data('tousername');
            makeChatDialogBox(to_user_id, to_user_name);
            $("#user_dialog_"+to_user_id).dialog({
                autoOpen:false,
                width:400
            });
            $('#user_dialog_'+to_user_id).dialog('open');
        });

        function update_last_activity()
        {
            $.ajax({
                url:"ajax/updateLastActivity.php",
                success:function(result)
                {
                    //console.log(result);
                }
            })
        }
        setInterval(function(){
            update_last_activity();
            fetch_user();
            update_chat_history_data();
        }, 5000);
    });
</script>
