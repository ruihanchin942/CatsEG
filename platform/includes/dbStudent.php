<?php
/***
 * Database functions for table student
 * Always require main db function first
 */
require_once 'dbFunction.php';

$table_student = "student";
$dbFields_student = ["id","school", "firstname", "lastname", "username", "nickname","profileImage", "pwd", "grade", "class","lastactivity", "status"];
$pk_student = "id";

/***
 * Get all classes
 * @param string $orderBy
 * @return array
 */
function getClassList($orderBy = ""){
    $orderBy = strlen($orderBy) > 0 ? "ORDER BY {$orderBy}" : "";
    return getStudentBySql("SELECT grade,class FROM {$GLOBALS['table_student']} WHERE status = 0 group by grade, class {$orderBy}");
}

/***
 * Get all students
 * @param string $orderBy
 * @return array
 */
function getAllStudents($orderBy = "") {
    $orderBy = strlen($orderBy) > 0 ? "ORDER BY {$orderBy}" : "";
    return getStudentBySql("SELECT * FROM {$GLOBALS['table_student']} {$orderBy}");
}

/***
 * Get students by unique id
 * @param int $id
 * @return bool|mixed
 */
function getByIdStudent($id = 0) { //get all the rows where record id = current id
    $result_array = getStudentBySql("SELECT *, aes_decrypt(pwd, 'deco3801') as password FROM {$GLOBALS['table_student']} WHERE {$GLOBALS['pk_student']}= {$id} AND status = 0 LIMIT 1 ");
    return !empty($result_array) ? array_shift($result_array) : false;
}

/***
 * Get student by sql
 * @param string $sql
 * @return array
 */
function getStudentBySql($sql = "") {
    $resultSet = query($sql);
    $resultArray = array();
    while ($row = fetch_array($resultSet)) {
        $resultArray[] = $row;
    }
    return $resultArray;
}

/***
 * Gets the last activity of students
 * @param $id
 * @return mixed
 */
function fetchStudentLastActivity($id)
{
    $resultSet = getStudentBySql("SELECT * FROM {$GLOBALS['table_student']} WHERE {$GLOBALS['pk_student']} = '$id' ORDER BY lastactivity DESC LIMIT 1");
    foreach($resultSet as $row)
    {
        return $row['lastactivity'];
    }
}

/***
 * Sets the field and value for student to be inserted or updated
 * @param $infoArr
 * @return array
 */
function setStudentAttributes($infoArr) { //set the fields //Gets the post data $infoArr is all the post data, [$fieldname] is the post names
    $newRecord = array();
    foreach ($GLOBALS['dbFields_student'] as $fieldName) {
        if (isset($infoArr[$fieldName])) { //if field name matches posts name
            $newRecord[$fieldName] = escape_value($infoArr[$fieldName]); //remove special characters.
        }
    }
    return $newRecord;
}

/***
 * Creates a new student record
 * @param array $infoArr
 * @return bool|int|string
 */
function createStudent($infoArr = array()) {
    foreach ($infoArr as $field => $value) {
        if ($value != "") {
            if ($field != 'pwd') {
                $updateStrArr[] = "'{$value}'";
                $updateStrArrField[] = "{$field}";
            } else {
                $updateStrArr[] = "AES_ENCRYPT('{$value}','deco3801')";
                $updateStrArrField[] = "{$field}";
                $updateStrArr[] = "0";
                $updateStrArrField[] = "status";
                $updateStrArr[] = "now()";
                $updateStrArrField[] = "lastactivity";
            }
        } else {
            $updateStrArr[] = "'{$value}'";
            $updateStrArrField[] = "{$field}";
        }
    }
    $updateStr = join(", ", array_values($updateStrArr));
    $updateStrField = join(", ", array_values($updateStrArrField));
    $sql = "INSERT INTO {$GLOBALS['table_student']} ";
    $sql .= "({$updateStrField}) VALUES ({$updateStr})";
    if (query($sql)) {

        return insert_id();
    } else {
        return false;
    }
}

/***
 * Updates student record
 * @param array $infoArr
 * @return bool
 */
function updateStudent($infoArr = array()) {
    if (array_key_exists($GLOBALS['pk_student'], $infoArr)) {
        $pkStr = "{$GLOBALS['pk_student']} = '{$infoArr[$GLOBALS['pk_student']]}'";
        unset($infoArr[$GLOBALS['pk_student']]);
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

        $sql = "UPDATE {$GLOBALS['table_student']} ";
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

