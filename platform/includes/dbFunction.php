<?php

require_once 'config.php';
/***
 * Starts the connection
 */
function open_connection() {
    global $connection;

    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    if (mysqli_connect_errno()) {
        die("Database connection failed: " .
                mysqli_connect_error() .
                " (" . mysqli_connect_errno() . ")");
    }
}

/***
 * Closes the connection
 */
function close_connection() {
    global $connection;
    if (isset($connection)) {
        mysqli_close($connection);
        unset($connection);
    }
}

/***
 * Runs the query and return the results
 * @param $sql
 * @return bool|mysqli_result
 */
function query($sql) {
    global $connection;
    $result = mysqli_query($connection, $sql);
    return $result;
}

/***
 * Fetches the array associated with the result
 * @param $result_set
 * @return array|null
 */
function fetch_array($result_set) {
    return mysqli_fetch_array($result_set);
}

/***
 * Gets the id inserted into the db
 * @return int|string
 */
function insert_id(){
    global $connection;
    // get the last id inserted over the current db connection
    return mysqli_insert_id($connection);
}

/***
 * Prepares the string to be inserted into mysql
 * @param $str
 * @return string
 */
function escape_value($str){
    global $connection;
    $escaped_str = mysqli_escape_string($connection, $str);
    return $escaped_str;
}

/***
 * Tracks if any row is updated
 * @return int
 */
function affected_rows() {
    global $connection;
    return mysqli_affected_rows($connection);
}

/***
 * Generates a random password
 * @return string
 */
function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

if( !function_exists('array_key_last') ) {
    function array_key_last(array $array) {
        if( !empty($array) ) return key(array_slice($array, -1, 1, true));
    }
}

if (!function_exists('array_key_first')) {
    function array_key_first(array $arr) {
        foreach($arr as $key => $unused) return $key;
    }
}

open_connection();

?>
