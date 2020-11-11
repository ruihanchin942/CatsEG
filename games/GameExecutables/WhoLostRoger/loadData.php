<?php
	session_start();

	if (!isset($_SESSION['student']) || !isset($_POST['getStudentProgress'])) {
		die("invalid request");
	}

	if (!isset($_SESSION['game_id']) || !isset($_SESSION['player_id'])) {
		die("invalid login to game");
	}

	if (($_POST['getStudentProgress'] != 'yes') || (!isset($_SESSION['highest_level']))) {
		die("invalid format of request");
	}

	echo "game_id:" . $_SESSION['game_id'] . "|" . "player_id:" . $_SESSION['player_id'] . "|" . "highest_level:" . $_SESSION['highest_level'];

	unset($_SESSION['highest_level']);
	exit("");
?>
