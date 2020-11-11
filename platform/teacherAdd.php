<?php
include_once 'includes/checkLoginStatusForBoth.php';
include_once 'includes/dbGame.php';
include_once 'includes/dbTeacher.php';
include_once 'includes/dbStudent.php';
include_once 'includes/dbSchool.php';
$grade = isset($_GET['grade']) ? $_GET['grade'] : '';
$class = isset($_GET['class']) ? $_GET['class'] : '';
$school = $user['school'];
$schoolInfo = getByIdSchool($user['school']);
if(isset($_GET['error']) && $_GET['error'] != ""){
    echo "<script type='text/javascript'>";
    echo "alert('{$_GET['error']}')";
    echo "</script>";
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Teacher Add Class</title>

    <?php
    include 'css.php';
    ?>
    <style>
        .hover-title {
            font-weight: bold;
            color: #0d6efd;
            display: inline;
            pointer-events: auto;
            cursor: pointer;
        }

        .hover-image {
            visibility: hidden;
        }

        body:not(.mobile) .hover-title:hover + .hover-image {
            visibility: visible;
            pointer-events: none;
        }

        .hover-image {
            display: flex;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
            pointer-events: none;
            flex-direction: column;
            align-items: center;
            justify-content: center;

            /* Change width and height to scale images */
            width: 90vw;
            height: 90vh;
        }

        .hover-image img {
            max-width: 100% !important;
            max-height: 100% !important;
            width: auto !important;
            height: auto !important;
            margin-bottom: 0;
        }
    </style>
</head>

<body>

<div class="container-fluid">
    <div class="row">
        <?php
        include_once("sideBar.php");
        ?>
        <div role="main" class="main col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="row" >
                <?php echo "<h1>{$schoolInfo['name']}, {$grade}{$class}</h1>" ?>
            </div>
            <div clas="form-row" style="margin-top: 5%">
                <form action="uploadClassExcelHandler.php" method="post"
                      name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
                    <div>
                        <p class="hover-title">CSV File only: </p>
                        <div class="hover-image"><img src="img/excelSample.png"></div>
                        <input type="hidden" name="class" value="<?=$class?>">
                        <input type="hidden" name="grade" value="<?=$grade?>">
                        <input type="hidden" name="schoolId" value="<?=$schoolInfo['id'];?>">
                        <input type="file" name="file"
                                                id="file" accept=".csv">
                        <button type="submit" id="submit" name="import"
                                class="btn-all">Import</button>

                    </div>

                </form>
            </div>
            <div class="table-responsive" style="position: absolute; margin-top: 2%; width: 80%;">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>Username</th>
                        <th>Password</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody id="studentTableBody">

                    </tbody>
                </table>
            </div>
            <form style="position: absolute; top: 75%; width: 80%;">
                <div class="form-row row">
                    <div class="col-lg-6">
                        Username:
                        <input type="text" style="background-color: #fff" class="text-input--underbar width-half" name="username" id="usernameInput" placeholder="Username" value="">
                    </div>
                </div>
                <div class="form-row row">
                    <div class="col-lg-6">
                        First Name:
                        <input type="text" style="background-color: #fff" class="text-input--underbar width-half" name="firstName" id="firstnameInput" placeholder="First Name" value="">
                    </div>
                    <div class="col-lg-6">
                        Last Name:
                        <input type="text" style="background-color: #fff" class="text-input--underbar width-half" name="lastName" id="lastnameInput" placeholder="Last Name" value="" style="border-width-left: 1px">
                    </div>
                </div>
                <hr>
            </form>
            <div clas="form-row" style="position: absolute; bottom: 1%; width: 80%; text-align: center;">
                <button  id="addStudentButton" class="btn-all">Add Student</button>
            </div>
            <div id="mainFooter" style="bottom:0; position: fixed;">
                <a class="btn-all mb-2" href="teacherMain.php">Back</a>
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
<script type="text/javascript">

    $(document).ready(function() {
        var html = "";
        refreshData();

        $("#addStudentButton").click(function(){
            var username = $('#usernameInput').val();
            var firstname = $('#firstnameInput').val();
            var lastname = $('#lastnameInput').val();

            if(username != "" && lastname != "" && firstname != ""){
                addClass(username,firstname,lastname);
            }else{
                alert("Please key in all the fields");
            }

        });

        function addClass(username,firstname,lastname){
            var username = username;
            var lastname = lastname;
            var password = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
            $.post("ajax/addStudent.php",
                {
                    grade: '<?= $grade?>',
                    class: '<?= $class?>',
                    school: <?= $school?>,
                    username: username,
                    lastname: lastname,
                    firstname: firstname,
                    pwd: password,
                    profileImage: "dummy.jpg"
                },
                function(result){
                    alert(result);
                    refreshData();
                });
        }

        function refreshData(){
            $.post("ajax/studentSearchFilter.php",
                {
                    grade: '<?= $grade?>',
                    class: '<?= $class?>',
                    school: <?= $school?>

                },
                function(result){
                    // console.log(result);
                    var result = $.parseJSON(result);
                    var string = "";
                    $("#studentTableBody").empty();
                    for(var i = 1; i <= result.length; i++){
                        string += "<tr>";

                        // string += "<td>";
                        // string += '<input type="checkbox" class="categoryIds" id="check1" name="category" value="' + result[i-1].id + '">';
                        // string += "</td>";

                        string += "<td>";
                        string += result[i-1].username ;
                        string += "</td>";
                        string += "<td>";
                        string += result[i-1].password ;
                        string += "</td>";
                        string += "<td>";
                        string += result[i-1].firstname ;
                        string += "</td>";
                        string += "<td>";
                        string += result[i-1].lastname ;
                        string += "</td>";
                        string += "<td>";
                        string += "<a href='studentProfile.php?id="+ result[i-1].id +"'>Edit</a>";
                        string += "</td>";
                        string += "</tr>";
                    }

                    $("#studentTableBody").append(string);
                    // console.log(string);

                });
        }

    });
</script>
</body>
</html>
