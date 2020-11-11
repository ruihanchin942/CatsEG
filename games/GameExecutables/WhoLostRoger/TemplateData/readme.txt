(Important) Steps
1. After WebGL build with player settings
2. Run the "index.php" for the game, not "index.html"

/*=========================== Divider ===========================*/

(Optional) Customized Settings
Enter colour in the "Background" field

/*=========================== Divider ===========================*/

(For Testing) Steps
If deploying the game, comment out the followings in the "index.php" file
If testing the game locally, uncomment out the followings in the "index.php" file

	// faked data for testing functionality
	$_SESSION['student'] = 1;
	$_SESSION['player_id'] = 1;
	$_SESSION['game_id'] = 1;
	$_SESSION['highest_level'] = 1;
