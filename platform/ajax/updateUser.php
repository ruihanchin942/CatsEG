<?php
require_once '../includes/dbStudent.php';

//used in teacher student to reset password
$updateUser = setStudentAttributes($_POST);

//$value = addslashes(file_get_contents($_FILES['profileImage']["tmp_name"]));
//$updateUser['profileImage'] = $value;


$updateResult = updateStudent($updateUser);

if ($updateResult) {
    echo "Updated";
}else{
    echo "Error Updating";
}





?>