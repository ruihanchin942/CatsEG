
<?php

require_once '../includes/dbAnnouncements.php';

$newAnnouncements = setAnnouncementAttributes($_POST);
$resultId = createAnnouncements($newAnnouncements);

close_connection();
if ($resultId) {
    header("location:../announcements.php");
    die();
}else{
    header("location:../announcements.php?error=something went wrong please try again later");
    die();
}




?>