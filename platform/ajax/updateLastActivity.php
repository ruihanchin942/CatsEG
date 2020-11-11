<?php

//update_last_activity.php

include('../includes/dbStudent.php');
include('../includes/dbTeacher.php');

session_start();
if (isset($_SESSION['student'])) { // basicinfo exist in session // from handle login
    $user = $_SESSION['student']; // get basicinfo from session
    $status = "student";

}elseif(isset($_SESSION['teacher'])){
    $user = $_SESSION['teacher'];
    $status = "teacher";
}

$sql = "
UPDATE {$status} 
SET lastactivity = now() 
WHERE id = '".$user["id"]."'
";
query($sql);
if (affected_rows() > 0) {
    echo "Updated last activity";
}else{
    echo "Unable to update last activity";
}
?>