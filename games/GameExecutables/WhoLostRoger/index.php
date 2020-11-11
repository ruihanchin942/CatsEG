<?php header('Access-Control-Allow-Origin: https://deco3801-cats.uqcloud.net/'); ?>

<?php
	session_start();
	require("connectDB.php");

	$platform_path = 'platform/index.php';

	// faked data for testing functionality
	//$_SESSION['student'] = 1;
	//$_SESSION['player_id'] = 1;
	//$_SESSION['game_id'] = 1;
	//$_SESSION['highest_level'] = 1;

	if (!isset($_SESSION['student']) || !isset($_SESSION['player_id']) || !isset($_SESSION['game_id'])) {
		$root_url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://';
		$server_url = $root_url . $_SERVER['SERVER_NAME'] . '/';
		$location = $server_url . $platform_path;
		header('Location: ' . $location);
	}

	$game_id = $_SESSION['game_id'];
	$player_id = $_SESSION['player_id'];
	$highest_level = 1;

	$database = new MySQLDatabase();
	$database->connect();
	$query = "SELECT * FROM who_lost_roger WHERE studentid='$player_id' ORDER BY level DESC LIMIT 1";
	$result = $database->query($query);
	if (!$result) {
		$database->disconnect();
		die("sql statement query fail");
	}
	if (($row = mysqli_fetch_array($result)) != NULL) {
		$highest_level = $row['level'];
	}
	$database->disconnect();

	$_SESSION['highest_level'] = $highest_level;

	// got this student progress here
	// going to send into the game
	include("index.html");
?>
