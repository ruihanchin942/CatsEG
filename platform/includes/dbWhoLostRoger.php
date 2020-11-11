<?php
/***
 * Database functions for table wholost roger
 * Always require main db function first
 */
require_once 'dbStudent.php';

$table_whoLostRoger = "who_lost_roger";
$dbFields_whoLostRoger = ["recordid", "studentid","score", "level", "percentage", "timeUsed", "nounsClicked", "dateTime", "status"];
$pk_whoLostRoger = "id";

/***
 * Gets record by sql
 * @param string $sql
 * @return array
 */
function getRogerBySql($sql = "") {
    $resultSet = query($sql);
    $resultArray = array();
    while ($row = fetch_array($resultSet)) {
        $resultArray[] = $row;
    }
    return $resultArray;
}

/***
 * Gets student progress by class
 * @param string $school
 * @return array
 */
function getProgressByClass($school = "") {
    $whereBySchool = strlen($school) > 0 ? " AND s.school = {$school}" : "";
    $result_array = getRogerBySql("SELECT AVG(score) as 'averageScore', grade, class FROM {$GLOBALS['table_whoLostRoger']} as sp , {$GLOBALS['table_student']} as s  WHERE sp.studentid = s.id {$whereBySchool}  AND s.status = 0 group by s.grade, s.class ");
    return $result_array;
}

/***
 * Gets the sql to get the high score of each player per level
 * @return string
 */
function getHighScoreOfEachPlayer(){
    $sql = "SELECT studentid, MAX(score) AS hiscore, level, nounsClicked, dateTime FROM who_lost_roger GROUP BY studentid, level ORDER BY hiscore DESC";
    return $sql;
}

/***
 * Returns the top players
 * @return array
 */
function getLeaderboard(){
    $highScoreOfEachPlayerSql = getHighScoreOfEachPlayer();
    $sql = "select sp.studentid, sum(sp.hiscore) as hiscore, s.username, s.firstname, s.lastname from ({$highScoreOfEachPlayerSql}) sp, student s where s.id = sp.studentid group by sp.studentid order by hiscore desc";
    $result_array = getRogerBySql($sql);
    return $result_array;
}

/***
 * Return the highscore of each student by class and grade
 * @param string $school
 * @param string $class
 * @param string $grade
 * @param string $orderBy
 * @param string $orderByType
 * @param string $studentId
 * @return array
 */
function getHighScoreOfEachStudentByClassAndGrade($school = "", $class = "", $grade = "", $orderBy = "", $orderByType = "", $studentId = ""){
    $whereBySchool = strlen($class) > 0 ? " AND s.school = {$school}" : "";
    $whereByClass = strlen($class) > 0 ? " AND s.class = '{$class}' " : "";
    $whereByGrade = strlen($grade) > 0 ? " AND s.grade = {$grade} " : "";
    $whereByStudentId = strlen($studentId) > 0 ? " AND s.id = {$studentId} " : "";
    $orderBySql = " order by hiscore desc ";
    if($orderBy != "" and $orderByType != "" ){
        $orderBySql = "order by ". $orderBy . " " . $orderByType . " ";
    }
    $whereSql = "Where sp.studentid = s.id ";
    if($whereBySchool != ""|| $whereByGrade != "" || $whereByClass != ""){
        $whereSql .= " " . $whereByGrade . $whereByClass . $whereBySchool . $whereByStudentId . " ";
    }
    $highScoreOfEachPlayerSql = getHighScoreOfEachPlayer();
    $sql = "select sp.studentid, sum(sp.hiscore) as 'sumScore', max(sp.level) as 'maxLevel', s.username, s.firstname, s.lastname from ({$highScoreOfEachPlayerSql}) as sp, student s {$whereSql} group by sp.studentid {$orderBySql}";
    $result_array = getRogerBySql($sql);
    return $result_array;
}

/***
 * Returns the play count of each student by month
 * @param string $school
 * @param string $class
 * @param string $grade
 * @param string $maxLevel
 * @param string $lowestLevel
 * @param string $studentId
 * @return array
 */
function playCount($school = "", $class = "", $grade = "", $maxLevel = "", $lowestLevel = "", $studentId = "") {
    $whereBySchool = strlen($class) > 0 ? " AND s.school = {$school}" : "";
    $whereByClass = strlen($class) > 0 ? " AND s.class = '{$class}' " : "";
    $whereByGrade = strlen($grade) > 0 ? " s.grade = {$grade} " : "";
    $whereMaxLevel = strlen($maxLevel) > 0 ? " AND sp.level <= {$maxLevel} " : "";
    $whereLowestLevel = strlen($lowestLevel) > 0 ? " AND sp.level >= {$lowestLevel} " : "";
    $whereByStudentId = strlen($studentId) > 0 ? " AND sp.studentid = {$studentId} " : "";
    $whereSql = "";
    if($whereBySchool != "" && $whereByGrade != "" && $whereByClass != ""){
        $whereSql .= " Where " . $whereByGrade . $whereByClass . $whereBySchool . " ";
    }
    $sql = "select MONTHNAME(sp.dateTime) as month, count(*) as playCount
                from who_lost_roger sp
                where sp.dateTime >= DATE_SUB(NOW(),INTERVAL 1 YEAR) AND
                studentid in (select id from student s {$whereSql} ) 
                {$whereLowestLevel} {$whereMaxLevel} {$whereByStudentId}
                group by MONTH(dateTime) ";
    $result_array = getRogerBySql($sql);
    return $result_array;
}

/***
 * Returns the data for each student learning outcomes
 * @param string $school
 * @param string $class
 * @param string $grade
 * @param string $maxLevel
 * @param string $lowestLevel
 * @param string $studentId
 * @return array
 */
function getLearningOutComes($school = "", $class = "", $grade = "", $maxLevel = "", $lowestLevel = "", $studentId = ""){
    $whereBySchool = strlen($class) > 0 ? "  s.school = {$school}" : "";
    $whereByClass = strlen($class) > 0 ? "  s.class = '{$class}' " : "";
    $whereByGrade = strlen($grade) > 0 ? "  s.grade = {$grade} " : "";
    $whereMaxLevel = strlen($maxLevel) > 0 ? " AND sp.level <= {$maxLevel} " : "";
    $whereLowestLevel = strlen($lowestLevel) > 0 ? " AND sp.level >= {$lowestLevel} " : "";
    $whereByStudentId = strlen($studentId) > 0 ? " AND sp.studentid = {$studentId} " : "";
    $whereSql = "";
    if($whereBySchool != "" && $whereByGrade != "" && $whereByClass != ""){
        $whereSql .= " WHERE " . $whereByGrade . " AND " .  $whereByClass . " AND " . $whereBySchool . $whereByStudentId . " ";
    }
    $highScoreOfEachPlayerSql = getHighScoreOfEachPlayer();
    $sql = "SELECT nounsClicked, level from ({$highScoreOfEachPlayerSql}) sp where sp.dateTime >= DATE_SUB(NOW(),INTERVAL 1 YEAR) AND studentid in (select id from student s {$whereSql} ) {$whereLowestLevel} {$whereMaxLevel} order by level asc";
    $result_array = getRogerBySql($sql);
    return $result_array;

}

