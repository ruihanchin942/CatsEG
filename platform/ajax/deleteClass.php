<?php
require_once '../includes/dbStudent.php';

$deleteArray = isset($_POST['deleteArray']) ? $_POST['deleteArray'] : "";
$whereSql = "";
if($deleteArray != ""){

    foreach($deleteArray as $deleteRow => $deleteId){
        if(strlen($whereSql) > 0){
            $whereSql .= " or id = {$deleteId} ";
        }else{
            $whereSql .= " Where id = {$deleteId} ";
        }
    }
    $sql = "select grade, class from student {$whereSql} group by grade, class  ";
    if (!mysqli_connect_errno()) {
        $resultArray = query ($sql); // execute the SQL query
        $deleteSql = "";
        foreach ($resultArray as $studentRow => $studentColumn){
            if(strlen($deleteSql) > 0){
                $deleteSql .= " or (grade = {$studentColumn['grade']} and class = '{$studentColumn['class']}') ";
            }else{
                $deleteSql .= " Where (grade = {$studentColumn['grade']} and class = '{$studentColumn['class']}') ";
            }
        }
        $sql = "Delete from student {$deleteSql}";
        $result = query ($sql); // execute the SQL query

        //Delets all record of game progress, add one new statement per new game
        $sql = "DELETE wlr FROM who_lost_roger wlr LEFT JOIN student s ON s.id = wlr.studentid WHERE s.id IS NULL";
        $result = query($sql);
        print_r("Record Updated");
        close_connection();
    }
}




