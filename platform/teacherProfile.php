<?php
include_once 'includes/checkLoginStatusForBoth.php';
include_once 'includes/dbGame.php';
include_once 'includes/dbStudent.php';
include_once  'includes/dbSchool.php';
$schoolInfo = getByIdSchool($user['school']);
$error = isset($_GET['error']) ? $_GET['error'] : "";
if($error != ""){
    echo "<script type='text/javascript'>alert('{$error}')</script>";
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Profile</title>

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
        <div role="main" class="main col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="row">
                <div class="col-lg-3" style="margin-top:4em">
                    <img width="150" height="150" src="img/<?=$user['profileImage'];?>" onerror="this.onerror=null; this.src='img/dummyimg.png'"/>
                    <div class="form-row">
                        <button style="font-size: 12px;" class="btn-all updateDetails" data-toggle="modal" data-target="#updateDetailsModal">Update Details</button>
                    </div>
                </div>
                <div class="col-lg-9" style="padding-top: 4em; font-size: 16px">
                    <div>
                        <b>Username:</b>
                        <h4><?= $user['username']; ?></h4>
                    </div>
                    <div class="form-row">
                        <br>
                        <b>Full Name</b><br/>
                        <?= $user['firstname'].' '.$user['lastname']; ?><br/>
                    </div>
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
include "modals/updateTeacherModal.php";
?>
</body>
</html>
