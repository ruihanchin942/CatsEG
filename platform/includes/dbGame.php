<?php
/***
 * Database functions for table game
 * Always require main db function first
 */
require_once 'dbFunction.php';

$table_game = "game";
$dbFields_game = ["id","name","subject", "description", "genre", "grade", "status"];
$pk_game = "id";

/***
 * Gets all games
 * @param string $orderBy
 * @return array
 */
function getAllGame($orderBy = "") {
    $orderBy = strlen($orderBy) > 0 ? "ORDER BY {$orderBy}" : "";
    return getGameBySql("SELECT * FROM {$GLOBALS['table_game']} WHERE status = 0 {$orderBy}");
}

/***
 * Gets game by unique ID
 * @param int $id
 * @return bool|mixed
 */
function getByIdGame($id = 0) { //get all the rows where record id = current id
    $result_array = getGameBySql("SELECT * FROM {$GLOBALS['table_game']} WHERE {$GLOBALS['pk_game']}= {$id} AND status = 0 LIMIT 1 ");
    return !empty($result_array) ? array_shift($result_array) : false;
}

/***
 * Get game by sql
 * @param string $sql
 * @return array
 */
function getGameBySql($sql = "") {
    $resultSet = query($sql);
    $resultArray = array();
    while ($row = fetch_array($resultSet)) {
        $resultArray[] = $row;
    }
    return $resultArray;
}
?>

