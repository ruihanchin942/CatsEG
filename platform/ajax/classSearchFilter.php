<?php
require_once "../includes/dbStudent.php";
$searchItem = isset($_POST['search']) ? $_POST['search'] : "";
$school = isset($_POST['school']) ? $_POST['school'] : "";
$whereSql = "Where status = 0 and school = {$school}";

if($searchItem != ""){
    $whereSql .= " and (firstname LIKE '%". $searchItem . "%' OR lastname LIKE '%". $searchItem . "%' )";
}

$sql = "Select id, grade, class, school from student ". $whereSql . " group by grade, class order by grade, class desc";
$resultSet = query($sql);
$resultArray = array();
while ($row = fetch_array($resultSet)) {
    array_push($resultArray,array(
        "id"=>$row['id'],
        "grade"=>$row['grade'],
        "class"=>$row['class'],
        "school"=>$row['school']
    ));
}
$resultJSON = json_encode($resultArray);
print_r($resultJSON);