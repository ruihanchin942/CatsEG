<?php
require_once '../includes/dbAnnouncements.php';

$deleteId = isset($_POST['id']) ? $_POST['id'] : "";
$_POST['status'] = isset($_POST['status']) ? $_POST['status'] : 1;
if($deleteId != ""){
    $announcementArr = setAnnouncementAttributes($_POST);
    $announcementStatus = deleteAnnouncement($announcementArr);
    if($announcementStatus){
        echo "deleted";
    }else{
        echo "error deleting";
    }
}




