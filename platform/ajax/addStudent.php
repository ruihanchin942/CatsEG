
<?php

require_once '../includes/dbStudent.php';
require_once '../includes/dbTeacher.php';

$getUsers = getAllStudents("id");
$getTeachers = getAllTeachers("id");

$newUser = setStudentAttributes($_POST);
$username = $_POST['username'];
foreach ($getUsers as $userDetails){
    if($username == $userDetails['username']){
        echo 'Username has been used for a student';
        die();
    }
}
foreach ($getTeachers as $userDetails){
    if($username == $userDetails['username']){
        echo 'Username has been used for a teacher';
        die();
    }
}

$resultId = createStudent($newUser);

close_connection();

if ($resultId) {
    echo "Account has been created";
    die();
}




?>