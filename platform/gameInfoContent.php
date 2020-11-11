<?php

$gameInfo = getByIdGame($gameId);
$gameName = $gameInfo['name'];
$gameSubject = $gameInfo['subject'];
$gameDescription = $gameInfo['description'];
$gameGrade = $gameInfo['grade'];
$gameGenre = $gameInfo['genre'];

$wholostroger_url = '../games/GameExecutables/WhoLostRoger/index.php';

$_SESSION['player_id'] = $user['id'];
$_SESSION['game_id'] = $gameId;


?>

<div role="main" class="main col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="row" id="gameName">
        <h1><?= $gameName;?></h1>
    </div>
    <div class="row" id="subject">
        <h3>Subject: <?= $gameSubject; ?></h3>
    </div>
    <div class="row" id="description">
        <h3>Description:</h3>
        <p>
            <?= $gameDescription;?>
        </p>
        <p id="genre">
            Genre: <?= $gameGenre;?>
        </p>
        <p id="grade">
            Grade: <?=$gameGrade;?>
        </p>
    
    </div>
    <?php
    if($status == "teacher"){
        echo '<a class="btn-all mb-2" style="margin-left: 4em; margin-top: 3em;" href="classesProgress.php?gameId='.$gameId.'">Student\'s Progress</a>';
    }elseif($status == "student"){

        echo '<a class="btn-all mb-2" style="margin-left: 4em; margin-top: 3em;" href="' . $wholostroger_url . '">Play</a><br/>';
        echo '<a class="btn-all mb-2" style="margin-left: 4em;" href="studentLeaderboard.php?gameId='.$gameId.'">Leaderboard</a><br/>';
    }
    ?>
</div>
