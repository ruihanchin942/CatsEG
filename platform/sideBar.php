<?php
include_once "includes/dbGame.php";
$games = getAllGame('subject');
?>
<nav class="col-md-2 d-none d-md-block" style="background-color: #96DFD8; padding: 0px">
    <div class="sidebar-sticky">
        <ul>
            <h2 style="overflow-wrap: break-word;">Welcome <?= $user['firstname']; ?>!</h2>
        </ul>
        <a href="announcements.php" id="sidebar-button"><ul class="sidebar-button-ul">Announcements</ul></a>
        </ul>
        <?php
        if($status == "teacher"){
            echo '<a href="teacherMain.php" id="sidebar-button"><ul class="sidebar-button-ul">
                        Classes
                        </ul></a>';
        }
        ?>
        <?php
        $subject = "";
        foreach($games as $row => $rowDetails ){
            if($rowDetails['subject'] != $subject){
                if(isset($gameId) && $gameId == $rowDetails['id']){ // selected language
                    echo "<button id='game" .$rowDetails['id']. "' class='collapsible active'>{$rowDetails['subject']}</button>";
                }else{
                    echo "<button class='collapsible'>{$rowDetails['subject']}</button>";
                }
            }

            if(isset($gameId) && $gameId == $rowDetails['id']){//selected page
                echo '<div class="content sidebar-button-collapsible" style="padding: 10%; max-height:20%;" onclick="selected(this)">';
                echo "<a href='gameInfo.php?gameId={$rowDetails['id']}' style='color: white;'>{$rowDetails['name']}</a>";
                echo '</div>';
            }else{
                echo '<div class="content" onclick="selected(this)">';
                echo "<a href='gameInfo.php?gameId={$rowDetails['id']}' class='btn contentbtn'>{$rowDetails['name']}</a>";
                echo '</div>';
            }


        }
        ?>

        <ul>
            <div class="row bottom-navbar">
                <div class="col-lg-3">

                    <img src="img/<?=$user['profileImage'];?>" onerror="this.onerror=null; this.src='img/dummyimg.png'" style="width: 50px; height: 50px;" >
                </div>
                <div class="col-lg-9">
                    <?php if ($status == "student"){
                        echo '<a class="profiletxt" href="studentProfile.php?id='.$user['id'].'">';
                    }else{
                        echo '<a class="profiletxt" href="teacherProfile.php">';
                    }
                    echo "<b>{$user['username']}</b>";
                    ?>
                    </a>
                    <div clas="row">
                        Status
                    </div>
                    <div clas="row">
                        <a class="onlineButton">Chat</a> |
                        <a class="logout" href="logoutHandler.php">Log Out</a>
                    </div>
                </div>
            </div>
        </ul>
    </div>
</nav>

<script>
    var divItems = document.getElementsByClassName("content");

    //if "content" is clicked/selected
    function selected(item) {
        this.clear();
        item.style.backgroundColor = '#d55464';
    }

    //if "content" is not clicked/selected, clearup
    function clear() {
        for(var i=0; i < divItems.length; i++) {
            var item = divItems[i];
            item.style.backgroundColor = '#96DFD8';
        }
    }
</script>
