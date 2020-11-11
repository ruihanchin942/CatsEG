<?php
include('../includes/dbTeacher.php');
include('../includes/dbStudent.php');
session_start();
$status = "";
if (isset($_SESSION['student'])) { // basicinfo exist in session // from handle login
    $status = "student";
    $school = $_SESSION['student']['school'];
}else if(isset($_SESSION['teacher'])){
    $school = $_SESSION['teacher']['school'];
}

$searchName = isset($_POST['searchName']) ? $_POST['searchName'] : '';
$searchSql = "";
if($searchName != ""){
    $searchSql = " && (firstname LIKE '%%{$searchName}%%' or lastname LIKE '%%{$searchName}%%' or username LIKE '%%{$searchName}%%') ";
}

date_default_timezone_set("Australia/Brisbane");


If ($status == "student"){
    $sql = "SELECT id, firstname, lastname, username FROM teacher where school = {$school} {$searchSql}  order by lastname desc";
}else{
    $sql = "SELECT id, firstname, lastname, username FROM student where school = {$school} {$searchSql} order by grade desc, class desc";
}


$result = query($sql);
$returnArray = array();
foreach($result as $row)
{
    $status = '';
    $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 30 second');
    $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
    if($status == "student"){
        $user_last_activity = fetchStudentLastActivity($row['id']);
    }else{
        $user_last_activity = fetchTeacherLastActivity($row['id']);
    }

    if($user_last_activity < $current_timestamp)
    {
        array_push($returnArray,$row);

    }
}

$resultJSON = json_encode($returnArray);
print_r($resultJSON);
