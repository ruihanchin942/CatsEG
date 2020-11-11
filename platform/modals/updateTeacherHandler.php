<?php
require_once '../includes/checkLoginStatusForBoth.php';
require_once '../includes/uploadImageFunction.php';
require_once '../includes/dbTeacher.php';
if($status == "teacher"){
    if (isset($_POST["update"])) {
        $id = $_POST['id'];
        $username = $_POST['username'];
        $profileImage = $_FILES['profileImage'];

        $updateDetails = setTeacherAttributes($_POST);
        if($profileImage != ""){
            $uploadResult = handleImageUpload($profileImage, "../".FOLDER_IMG, $id);
            if ($uploadResult) {
                $updateDetails['profileImage'] = $uploadResult;
                $teacherDetails = getByIdTeacher($id);
                $updatingImage = 1;
            }else{
                header("Location: ../teacherProfile.php?error=Upload {$uploadResult} failed");
            }
        }
        $updateResult = updateTeacher($updateDetails);
        if ($updateResult) {
            $row = getByIdTeacher($id);
            $_SESSION['teacher'] = $row; // put the record into the session
            if (file_exists("img/" . $teacherDetails['profileImage']) && $updatingImage == 1) {
                unlink("img/" . $teacherDetails['profileImage']);
            }
            header("Location: ../teacherProfile.php");
        }else{
            header("Location: ../teacherProfile.php?error=Update Failed");
        }

    } else {
        header("Location: ../teacherProfile.php?error=Update Failed");
    }
}else {
    $id = $_POST['id'];
    header("Location: ../teacherProfile.php?error=Update Failed session error");
}





?>
