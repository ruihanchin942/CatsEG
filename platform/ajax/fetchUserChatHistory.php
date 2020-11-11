<?php
include('../includes/dbFunction.php');

session_start();
if (isset($_SESSION['student'])) { // basicinfo exist in session // from handle login
    $user = $_SESSION['student']; // get basicinfo from session
    $status = "student";
}elseif(isset($_SESSION['teacher'])){
    $user = $_SESSION['teacher'];
    $status = "teacher";
}
$receiverId = $_POST['to_user_id']; //receiver
$senderId = $user['id']; //sender
if($status == "student"){
    $studentId = $user['id'];
    $teacherId = $receiverId;
}else{
    $teacherId = $user['id'];
    $studentId = $receiverId;
}
echo fetch_user_chat_history();

function fetch_user_chat_history()
{
    $sql = "
 SELECT * FROM chat_message 
 WHERE studentId = {$GLOBALS['studentId']} and teacherId = {$GLOBALS['teacherId']}
 ORDER BY timestamp asc
 ";
    $result = query($sql);

    $output = '<ul class="list-unstyled">';
    foreach($result as $row)
    {
        $user_name = '';
        if($row["status"] == 0 && $GLOBALS['status'] == 'student') {
            $user_name = '<b class="text-success">You</b>';
        } else if($row["status"] == 1 && $GLOBALS['status'] == 'teacher') {
            $user_name = '<b class="text-success">You</b>';
        }else{
            if($GLOBALS['status'] == "teacher"){
                $user_name = '<b class="text-danger">'.getName($row['studentId'], "student").'</b>';
            }else{
                $user_name = '<b class="text-danger">'.getName($row['teacherId'], "teacher").'</b>';
            }
        }
        $output .= '
          <li style="border-bottom:1px dotted #ccc">
           <p>'.$user_name.' <br> '.$row["message"].'
            <div align="right">
             - <small><em>'.$row['timestamp'].'</em></small>
            </div>
           </p>
          </li>
          ';
    }
    $output .= '</ul>';
    echo $output;
}

function getName($user_id, $status)
{
    $sql = "SELECT firstname, lastname FROM $status WHERE id = '$user_id' limit 1";
    $result = query($sql);
    foreach($result as $row)
    {
        return $row['firstname'] . $row['lastname'];

    }
}