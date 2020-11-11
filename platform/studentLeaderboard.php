<?php
include_once 'includes/checkLoginStatusForBoth.php';
include_once 'includes/dbGame.php';
include_once 'includes/dbWhoLostRoger.php';
$gameId = isset($_GET['gameId']) ? $_GET['gameId'] : "1";
$studentRecords = getLeaderboard();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Leaderboard</title>

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
            <div class="row">
                <h1><b>Who Lost Roger?</b></h1>
            </div>
            <div id="sub-heading">
                <h4><b>Leaderboard</b></h4>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Total Score</th>
                        <th>Rank</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $rank = 1;
                    foreach ($studentRecords as $student => $record){

                        echo "<tr>";

                        echo "<td>";
                        echo $record['firstname'] . " " . $record['lastname'];
                        echo "</td>";
                        echo "<td>";
                        echo $record['hiscore'];
                        echo "</td>";
                        echo "<td>";
                        echo $rank;
                        echo "</td>";

                        echo "</tr>";
                        $rank +=1;
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
    <!-- Bootstrap core JavaScript
================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php
    include 'lastActivity.php';
    ?>
</body>
</html>