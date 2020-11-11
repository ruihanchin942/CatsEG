<?php
include_once 'includes/checkLoginStatusForBoth.php';
include_once 'includes/dbGame.php';
include_once 'includes/dbTeacher.php';
$gameId = isset($_GET['gameId']) ? $_GET['gameId'] : "1";
$gameInfo = getByIdGame($gameId);
if($gameInfo == ""){ //if id returns blank, load game 1
    $gameInfo = getByIdGame(1);
    $gameId = 1;
}
$gameName = $gameInfo['name'];
$gameSubject = $gameInfo['subject'];
$gameDescription = $gameInfo['description'];
$gameGrade = $gameInfo['grade'];
$gameGenre = $gameInfo['genre'];
$classRecords = [];
if($gameId == 1){
    include_once 'includes/dbWhoLostRoger.php';
    $classRecords = getProgressByClass($user['school']);
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Teacher Student Progress by Class</title>

    <?php
    include 'css.php';
    ?>
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <?php
        include_once("sideBar.php");
        ?>
        <div role="main" class="main col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="row" id="gameName">
                <h1><?=$gameName?></h1>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>Grade</th>
                        <th>Class</th>
                        <th>Avg Score</th>
                        <th>View</th>
                    </tr>
                    </thead>
                    <tbody id="tableBodyStudentProgressByClass">
                    <?php
                    foreach ($classRecords as $class => $record){

                        echo "<tr>";

                        echo "<td>";
                        echo $record['grade'];
                        echo "</td>";
                        echo "<td>";
                        echo $record['class'];
                        echo "</td>";
                        echo "<td>";
                        echo round($record['averageScore'], 2, PHP_ROUND_HALF_UP);
                        echo "</td>";
                        echo "<td><a href= 'studentsProgress.php?grade={$record['grade']}&class={$record['class']}&gameId={$gameId}'>";
                        echo "View</a></td>";

                        echo "</tr>";

                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <div id="mainFooter" style="bottom:0; position: fixed;">
                <a class="btn-all" href="javascript:history.back()">Back</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php
include 'lastActivity.php';
?>

</body>
</html>
