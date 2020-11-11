<?php
/***
 * Database functions for table school
 * Always require main db function first
 */
require_once 'dbFunction.php';

$table_school = "school";
$dbFields_school = ["id","name", "status"];
$pk_school = "id";

/***
 * Get school by unique ID
 * @param int $id
 * @return bool|mixed
 */
function getByIdSchool($id = 0) { //get all the rows where record id = current id
    $result_array = getSchoolBySql("SELECT * FROM {$GLOBALS['table_school']} WHERE {$GLOBALS['pk_school']}= {$id} AND status = 0 LIMIT 1 ");
    return !empty($result_array) ? array_shift($result_array) : false;
}

/***
 * Get school by sql
 * @param string $sql
 * @return array
 */
function getSchoolBySql($sql = "") {
    $resultSet = query($sql);
    $resultArray = array();
    while ($row = fetch_array($resultSet)) {
        $resultArray[] = $row;
    }
    return $resultArray;
}
?>

