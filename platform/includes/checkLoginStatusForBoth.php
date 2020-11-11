<?php
// start a session
session_start();

$now = time();

if (isset($_SESSION['discard_after']) && $now > $_SESSION['discard_after'] && $now < ($_SESSION['discard_after']+7200)) {
    // this session has worn out its welcome; kill it and start a brand new one
    $_SESSION['discard_after'] = $now + 3600;


}else if(isset($_SESSION['discard_after']) && $now > $_SESSION['discard_after']){ //any value more than 2 hrs
    session_unset();
    session_destroy();
    session_start();
}

if (isset($_SESSION['student'])) { // basicinfo exist in session // from handle login
    $user = $_SESSION['student']; // get basicinfo from session
    $status = "student";
}elseif(isset($_SESSION['teacher'])){
    $user = $_SESSION['teacher'];
    $status = "teacher";
} else {
    header('Location: index.php'); // redirect to the login page.
}
?>

