<?php

//insertChat.php

include('../includes/dbFunction.php');

session_start();
if (isset($_SESSION['student'])) { // basicinfo exist in session // from handle login
    $user = $_SESSION['student']; // get basicinfo from session
    $status = "student";
}elseif(isset($_SESSION['teacher'])){
    $user = $_SESSION['teacher'];
    $status = "teacher";
}

$receiverId = $_POST['to_user_id']; //receiver
$senderId = $user['id']; //sender
$message  = $_POST['chat_message'];
if($status == "student"){
    $studentId = $user['id'];
    $teacherId = $receiverId;
    $chatStatus = 0;
}else{
    $teacherId = $user['id'];
    $studentId = $receiverId;
    $chatStatus = 1;
}
$sql = "INSERT INTO chat_message (teacherId, studentId, message, timestamp, status)"
    . " VALUES ({$teacherId}, {$studentId}, '{$message}', now() ,$chatStatus)";
if(query($sql)) {
    echo "inserted";
}else{
    echo $sql;
}

?>