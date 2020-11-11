<?php
include_once 'includes/checkLoginStatusForBoth.php';
include_once 'includes/dbGame.php';
include_once 'includes/dbTeacher.php';
include_once  'includes/dbSchool.php';
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

    <title>Teacher Home</title>

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
                <?php echo "<h1>{$schoolInfo['name']}</h1>" ?>
            </div>
            <div class="row" id="searchbar-row" style="position: absolute; top: 50px; width: 80%">
                <div class="col-lg-6">
                    <input id='searchClass' name='search_name' style= "background-color: #fff" class="form-control" type="text" placeholder="Search classes/students..." aria-label="Search">
                </div>
                <div class="col-lg-3"></div>
                <div class="col-lg-3">
                            <button type="button" class="btn-all" data-toggle="modal" data-target="#addClassModal">Add Class</button>
                </div>
            </div>

            <div class = "row" style="position: absolute; top: 200px; width: 80%">
                <div class="col-lg-3">
                    <a type="button" class="btn-all" id="deleteClassButton" style='color: white; text-decoration: none;'>Delete Class</a>
                </div>
            </div>
            <div class="table-responsive" style="position: absolute; max-height: 30%; top: 250px; width: 80%">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>Select</th>
                        <th>Grade</th>
                        <th>Class</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody id="classTableBody">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div id="addClassModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content" style="background-color: #effffd">
            <div class="modal-header" style="background-color: #48BEB5; color: white">
                <h4 class="modal-title">Add Class</h4>
            </div>
            <div class="modal-body">
                <form method="get" action="teacherAdd.php">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="selectClass">Grade</label>
                            <select class="form-control" style="background-color: #BCE8E3" name="grade" id="selectGrade">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option>10</option>
                                <option>11</option>
                                <option>12</option>
                            </select>
                        </div>
                        <br>
                        <label for="selectClass">Class</label>
                        <select class="form-control" name="class" style="background-color: #BCE8E3" id="selectClass">
                            <option>A</option>
                            <option>B</option>
                            <option>C</option>
                            <option>D</option>
                            <option>E</option>
                            <option>F</option>
                            <option>G</option>
                            <option>H</option>
                            <option>I</option>
                            <option>J</option>
                            <option>K</option>
                        </select>
                    </div>
                    <br>
                    <button type="submit" class="btn-all">Add</button>
                    <button type="button" class="btn-all" data-dismiss="modal">Close</button>
                </form>
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
        var search = "";
        var html = "";
        refreshData();
        $('input[name=search_name]').on('input',function(e){
            search = $(this).val();
            refreshData();
        });

        $("#deleteClassButton").click(function(){
            var deleteArray = []
            $("input:checkbox[name=classes]:checked").each(function(){
                deleteArray.push($(this).val());
            });
            deleteClass(deleteArray);

        });

        function deleteClass(deleteArray){
            $.post("ajax/deleteClass.php",
                {
                    deleteArray: deleteArray
                    
                },
                function(result){
                    alert(result);
                    refreshData();
                });
        }

        function refreshData(){
            $.post("ajax/classSearchFilter.php",
                {
                    search: search,
                    school: <?php echo $schoolInfo['id']; ?>
                },
                function(result){
                    var result = $.parseJSON(result);
                    var string = "";
                    $("#classTableBody").empty();
                    for(var i = 1; i <= result.length; i++){
                        string += "<tr>";

                        string += "<td>";
                        string += '<input type="checkbox" class="categoryIds" id="check1" name="classes" value="' + result[i-1].id + '">';
                        string += "</td>";

                        string += "<td>";
                        string += result[i-1].grade ;
                        string += "</td>";
                        string += "<td>";
                        string += result[i-1].class ;
                        string += "</td>";
                        string += "<td>";
                        string += "<a href='teacherClass.php?grade="+ result[i-1].grade + "&class=" + result[i-1].class + "&school=" + result[i-1].school + "'>Edit</a>";
                        string += "</td>";
                        string += "</tr>";
                    }
                    $("#classTableBody").append(string);
                    //console.log(string);

                });
        }

    });
</script>

</body>
</html>
