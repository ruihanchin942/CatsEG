<?php
require_once "../includes/dbStudent.php";
$searchItem = isset($_POST['search']) ? $_POST['search'] : "";
$class = isset($_POST['class']) ? $_POST['class'] : "";
$grade = isset($_POST['grade']) ? $_POST['grade'] : "";
$school = isset($_POST['school']) ? $_POST['school'] : "";
$whereSql = "Where status = 0 and grade ='{$grade}' and school ={$school} and class = '{$class}' ";

if($searchItem != ""){
    $whereSql .= " and (firstname LIKE '%". $searchItem . "%' OR lastname LIKE '%". $searchItem . "%' )";
}

$sql = "Select id, firstname, lastname, username, AES_DECRYPT(pwd, 'deco3801') as password from student ". $whereSql . " order by firstname, lastname desc";

$resultSet = query($sql);
$resultArray = array();
while ($row = fetch_array($resultSet)) {
    array_push($resultArray,array(
        "id"=>$row['id'],
        "firstname"=>$row['firstname'],
        "lastname"=>$row['lastname'],
        "username"=>$row['username'],
        "password"=>$row['password']
    ));
}
$resultJSON = json_encode($resultArray);
print_r($resultJSON);