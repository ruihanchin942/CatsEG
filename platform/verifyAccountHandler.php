<?php
require_once 'includes/dbStudent.php';
if (isset($_POST["update"])) {
    $id = $_POST['id'];

    $updateDetails = setStudentAttributes($_POST);
    $updateResult = updateStudent($updateDetails);
    if ($updateResult) {
        if($_POST['statustype'] == "student"){
            $row = getByIdStudent($id);
            $_SESSION['student'] = $row; // put the record into the session
        }
        header("Location: index.php?error=Account Verified, Please login again");
    }else{
        header("Location: verifyAccount.php?error=Error updating record, please try again");
    }

}