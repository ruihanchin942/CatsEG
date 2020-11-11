<?php

require_once 'includes/dbStudent.php';
$grade = isset($_POST['grade']) ? $_POST['grade'] : "";
$class = isset($_POST['class']) ? $_POST['class'] : "";
if(isset($_POST["import"]) && isset($_POST['schoolId']) && isset($_POST['grade']) && isset($_POST['class']) !="")
{
    echo $filename=$_FILES["file"]["tmp_name"];
    if($_FILES["file"]["size"] > 0)
    {
        $file = fopen($filename, "r");

        $count = 0;
        while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
        {
            $count++;

            if($count>1){
                $studentArray = ["school"=>$_POST['schoolId'],"firstname" => "$emapData[1]","lastname"=>"$emapData[2]","username"=>"$emapData[3]","pwd"=>"$emapData[4]","grade"=>"$emapData[5]","class"=>"$emapData[6]"];
                $studentArray = setStudentAttributes($studentArray);
                $studentCreationStatus = createStudent($studentArray);
                //print_r($studentCreationStatus);
                if($studentCreationStatus){
                    echo "Uploaded Students";
                }else{
                    print_r($studentArray);
                }

            }
        }
        fclose($file);
        header("Location: teacherAdd.php?grade={$grade}&class={$class}&error=CSV File has been successfully Imported");
    }
    else{
        header("Location: teacherAdd.php?grade={$grade}&class={$class}&error=Invalid File:Please Upload CSV File");
    }

}else{
    header("Location: teacherMain.php?error=Upload Error");
}
?>