<?php
include_once 'includes/checkLoginStatusForBoth.php';
include_once 'includes/dbAnnouncements.php';
include_once 'includes/dbStudent.php';
$announcementType = "";
if($status == "student"){
    $announcementType = $user['grade'] . $user['class'];
}
$announcementSql = getAllAnnouncementWithTeacherName("",$announcementType,"0", "10");
$announcementArr = getAnnouncementsBySql($announcementSql);
$classArr = getClassList();
if(isset($_GET['error']) && $_GET['error'] != ""){
    echo "<script type='text/javascript'>";
    echo "alert('{$_GET['error']}')";
    echo "</script>";
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Announcements</title>

    <?php
    include 'css.php';
    ?>
</head>

<body>

<div class="container-fluid">
    <div class="row">
        <?php
        include_once("sideBar.php");
        ?>
        <div role="main" class="main col-md-9 ml-sm-auto col-lg-10 px-4" >
            <div style="overflow-y: scroll; overflow-x: hidden; width: 80%; position: absolute; margin-top: -3%">
                <div class="jumbotron text-left">
                    <div class="row">
                        <h1 class="col-lg-10" id="anntitle">Announcements</h1>
                        <?php
                        if($status == "teacher"){?>
                            <div class="col-lg-2" id="announcements">
                                <button class="btn-all" id="annbutton" style="white-space: nowrap" data-toggle="modal" data-target="#newAnnouncementModal">Add Announcements</button>
                            </div>
                            <?php
                            include 'modals/newAnnouncementModal.php';
                        }
                        ?>
                        <hr>
                    </div>
                </div>
                <div class="container">
                    <?php
                    foreach($announcementArr as $key => $value) {
                        ?>
                        <div class="row border rounded" name="row<?=$value['id']?>">
                            <div class="text-left col-lg-10" id="annbox">
                                <h3><?php
                                    echo $value['title'];
                                    ?></h3>
                                <p><?php
                                    echo $value['message'];
                                    ?></p>
                                <span>
                                By:
                                <?php
                                echo $value['firstname'] . " " . $value['lastname'];
                                ?>
                            </span>
                                <br>
                                <span>
                                    <?php
                                    echo $value['timeStamp'];
                                    ?>
                                </span>
                            </div>
                            <?php
                            if($status == "teacher"){?>
                                <div class="col-lg-2">
                                    <button class="btn-all deleteAnnouncementButton" name="<?=$value['id']?>">Delete</button>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php
include 'lastActivity.php';
?>
<script type="text/javascript">
    $(document).ready(function() {
        addListener();
    });

    function addListener() {
        $('body').on('click', '.deleteAnnouncementButton', function() {
            deleteAnnouncement(this.name)
        });
    }

    function deleteAnnouncement(id){
        $.ajax({
            url:"ajax/deleteAnnouncement.php",
            method:"POST",
            data:{id:id},
            success:function(data)
            {
                var nameid = id;
                $( "[name =row"+ nameid +"]" ).remove();
            }
        })
    }
</script>

</body>
</html>
