<?php
require_once '../includes/checkLoginStatusForBoth.php';
require_once '../includes/uploadImageFunction.php';
require_once '../includes/dbStudent.php';
if (isset($_POST["update"])) {
    $id = $_POST['id'];
    $profileImage = $_FILES['profileImage'];

    $updateDetails = setStudentAttributes($_POST);
    if($profileImage != ""){
        $uploadResult = handleImageUpload($profileImage, "../".FOLDER_IMG, $id);
        if ($uploadResult) {
            $updateDetails['profileImage'] = $uploadResult;
            $studentDetails = getByIdStudent($id);
            $updatingImage = 1;
        }else{
            header("Location: ../studentProfile.php?id={$id}&error=Upload {$uploadResult} failed");
        }
    }
    $updateResult = updateStudent($updateDetails);
    if ($updateResult) {
        if($_POST['statustype'] == "student"){
            $row = getByIdStudent($id);
            $_SESSION['student'] = $row; // put the record into the session
        }
        if (file_exists("img/" . $studentDetails['profileImage']) && $updatingImage == 1) {
            unlink("img/" . $studentDetails['profileImage']);
        }
        header("Location: ../studentProfile.php?id={$id}");
    }else{
        header("Location: ../studentProfile.php?id={$id}&error=Update Failed, nothing to update.");
    }

} else {
    $id = $_POST['id'];
    header("Location: ../studentProfile.php?id={$id}&error=Status Error Unable to update now, please relogin and try again");
}





?>
