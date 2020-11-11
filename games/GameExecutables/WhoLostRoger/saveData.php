<?php
	include("connectDB.php");

	if (isset($_POST['game_id']) && isset($_POST['player_id'])
			&& isset($_POST['current_level']) && isset($_POST['final_score'])
			&& isset($_POST['noun_percentage']) && isset($_POST['time_used'])
			&& isset($_POST['nouns_clicked'])) {

		$game_id = $_POST['game_id'];
		$player_id = $_POST['player_id'];
		$current_level = $_POST['current_level'];
		$final_score = $_POST['final_score'];
		$noun_percentage = $_POST['noun_percentage'];
		$time_used = $_POST['time_used'];
		$nouns_clicked = $_POST['nouns_clicked'];

		date_default_timezone_set('Australia/Brisbane');
		$current_date = date('Y-m-d H:i:s');

		$database = new MySQLDatabase();
		$database->connect();
		$query = "INSERT INTO who_lost_roger (studentid, score, level, percentage, timeUsed, nounsClicked, dateTime, status) VALUES ('$player_id', '$final_score', '$current_level', '$noun_percentage', '$time_used', '$nouns_clicked', '$current_date', '0')";
		$result = $database->query($query);
		$database->disconnect();

		if ($result) { exit("success"); } else { die("fail"); }
	}
?>
