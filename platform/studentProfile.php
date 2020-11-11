<?php
include_once 'includes/checkLoginStatusForBoth.php';
include_once 'includes/dbGame.php';
include_once 'includes/dbStudent.php';
include_once  'includes/dbSchool.php';
$schoolInfo = getByIdSchool($user['school']);
$studentId = isset($_GET['id']) ? $_GET['id'] : 0;
$error = isset($_GET['error']) ? $_GET['error'] : "";
if($error != ""){
    echo "<script type='text/javascript'>alert('{$error}')</script>";
}
$string = "";
if($studentId == 0){
    echo "<script type='text/javascript'>history.back();</script>";
}
//prevents student from going other profiles
if($status == "student" and $user['id'] != $studentId){
    echo "<script type='text/javascript'>history.back();</script>";
}

$studentInfo = getByIdStudent($studentId);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Student Profile</title>
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
        <div role="main" class=" main col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="row">
                <div class="col-lg-3" style="margin-top:4em">
                    <img width="150" height="150" src="img/<?=$studentInfo['profileImage'];?>" onerror="this.onerror=null; this.src='img/dummyimg.png'"/>
                    <div class="form-row">
                        <button style="font-size: 12px;" class="btn-all updateDetails" data-toggle="modal" data-target="#updateDetailsModal">Update Details</button>
                        <br>
                        <br>
                        <?php
                        if($status == "teacher"){
                            echo '<button style="font-size: 12px;" class="btn-all resetPassword" data-toggle="modal" data-target="#resetStudentPasswordModal">Reset Password</button><br/>';
                        }
                        ?>
                    </div>
                </div>
                <div class="col-lg-9" style="padding-top: 4em; font-size: 16px">
                    <div>
                        <b>Username:</b>
                        <h4><?= $studentInfo['username']; ?></h4>
                    </div>
                    <div class="form-row">
                        <br>
                        <b>Full Name</b><br/>
                        <?= $studentInfo['firstname'].' '.$studentInfo['lastname']; ?><br/>
                    </div>
                    <div class="form-row">
                        <b>Nickname</b><br/>
                        <?= $studentInfo['nickname']; ?><br/>
                    </div>
                    <?php
                    if($status == "teacher"){
                        echo "<div class='form-row'><b>Password</b><br/>{$studentInfo["password"]}<br/></div>";
                    }
                    ?>
                    <div class="form-row">
                        <b>Grade</b><br/>
                        <?= $studentInfo['grade']; ?><br/>
                    </div>
                    <div class="form-row">
                        <b>Class</b><br/>
                        <?= $studentInfo['class']; ?><br/>
                    </div>
                    <div class="form-row">
                        <b>School</b><br/>
                        <?= $schoolInfo['name']; ?><br/>
                    </div>
                </div>
            </div>
            <div id="mainFooter" style="bottom:0; position: fixed;">
                <a class="btn-all" href="javascript:history.back()">Back</a>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php

include "modals/updateStudentModal.php";
include "modals/resetStudentPasswordModal.php";
include "lastActivity.php";
?>
</body>
</html>
