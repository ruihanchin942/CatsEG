<?php
require_once '../includes/dbStudent.php';

$deleteArray = isset($_POST['deleteArray']) ? $_POST['deleteArray'] : "";
$deleteSql = "";
if($deleteArray != ""){
    foreach($deleteArray as $deleteRow => $deleteId){
        if(strlen($deleteSql) > 0){
            $deleteSql .= " or id = {$deleteId} ";
        }else{
            $deleteSql .= " Where id = {$deleteId} ";
        }
    }
    $sql = "Delete from student {$deleteSql}";
    if (!mysqli_connect_errno()) {
        $result = query ($sql); // execute the SQL query
        //Delets all record of game progress, add one new statement per new game
        $sql = "DELETE wlr FROM who_lost_roger wlr LEFT JOIN student s ON s.id = wlr.studentid WHERE s.id IS NULL";
        $result = query($sql);
        print_r("Record Updated");
        close_connection();
    }
}




