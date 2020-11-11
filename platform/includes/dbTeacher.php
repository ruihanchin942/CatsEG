<?php
/***
 * Database functions for table teacher
 * Always require main db function first
 */
require_once 'dbFunction.php';

$table_teacher = "teacher";
$dbFields_teacher = ["id","school", "firstname", "lastname", "username","profileImage", "pwd","lastactivity","status"];
$pk_teacher = "id";


/***
 * Gets all teachers
 * @param string $orderBy
 * @return array
 */
function getAllTeachers($orderBy = "") {
    $orderBy = strlen($orderBy) > 0 ? "ORDER BY {$orderBy}" : "";
    return getTeacherBySql("SELECT * FROM {$GLOBALS['table_teacher']} {$orderBy}");
}

/***
 * Gets teacher by Id
 * @param int $id
 * @return bool|mixed
 */
function getByIdTeacher($id = 0) { //get all the rows where record id = current id
    $result_array = getTeacherBySql("SELECT *, aes_decrypt(pwd, 'deco3801') as password FROM {$GLOBALS['table_teacher']} WHERE {$GLOBALS['pk_teacher']}= {$id} AND status = 0 LIMIT 1 ");
    return !empty($result_array) ? array_shift($result_array) : false;
}

/***
 * Gets teacher by SQL
 * @param string $sql
 * @return array
 */
function getTeacherBySql($sql = "") {
    $resultSet = query($sql);
    $resultArray = array();
    while ($row = fetch_array($resultSet)) {
        $resultArray[] = $row;
    }
    return $resultArray;
}

/***
 * Fetch the last activity of students
 * @param $id
 * @return mixed
 */
function fetchTeacherLastActivity($id)
{
    $resultSet = getStudentBySql("SELECT * FROM {$GLOBALS['table_teacher']} WHERE {$GLOBALS['pk_teacher']} = '$id' ORDER BY lastactivity DESC LIMIT 1");
    foreach($resultSet as $row)
    {
        return $row['lastactivity'];
    }
}

/***
 * Sets the field and value to be inserted or updated into table
 * @param $infoArr
 * @return array
 */
function setTeacherAttributes($infoArr) { //set the fields //Gets the post data $infoArr is all the post data, [$fieldname] is the post names
    $newRecord = array();
    foreach ($GLOBALS['dbFields_teacher'] as $fieldName) {
        if (isset($infoArr[$fieldName])) { //if field name matches posts name
            $newRecord[$fieldName] = escape_value($infoArr[$fieldName]); //remove special characters.
        }
    }
    return $newRecord;
}

/***
 * Updates teacher record
 * @param array $infoArr
 * @return bool
 */
function updateTeacher($infoArr = array()) {
    if (array_key_exists($GLOBALS['pk_teacher'], $infoArr)) {
        $pkStr = "{$GLOBALS['pk_teacher']} = '{$infoArr[$GLOBALS['pk_teacher']]}'";
        unset($infoArr[$GLOBALS['pk_teacher']]);
        $updateStrArr = array();
        foreach ($infoArr as $field => $value) {
            if ($value != "") {
                if ($field != 'pwd') {
                    $updateStrArr[] = "{$field}='{$value}'";
                } else {
                    $updateStrArr[] = "{$field}=AES_ENCRYPT('{$value}','deco3801')";
                }
            }
        }
        $updateStr = join(", ", array_values($updateStrArr));

        $sql = "UPDATE {$GLOBALS['table_teacher']} ";
        $sql .= "SET {$updateStr} ";
        $sql .= "WHERE {$pkStr}";
        query($sql);
        if (affected_rows() > 0) {
            return true;
        }
    }
    return false;
}
?>

