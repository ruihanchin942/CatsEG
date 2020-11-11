<?php
/***
 * Uploads new image to the server and update profileimage record for user
 * @param $newFile
 * @param string $folder
 * @param string $recordid
 * @return string
 */
function handleImageUpload($newFile, $folder = "", $recordid = "") {
    $result = false;
    
    
    if ($newFile["error"] == 0) { // means no error
     //anything more than 0 is called an error $_FILES["myFile"] change to $newFile
        //echo "Error: " . $newFile["error"] . "<br>";
       // echo "Upload: " . $newFile["name"] . "<br>";
       // echo "Type: " . $newFile["type"] . "<br>";
       // echo "Size: " . ($newFile["size"] / 1024) . " kB<br>"; //1024b is 1 kb
       // echo "Stored in: " . $newFile["tmp_name"] . "</br>";

        // check the file extension, only accept jpg or jpeg
        $allowedExts = ["jpg", "jpeg"];
        //xx.xx.jpeg into xx xx jpeg
        $filenameStrArr = explode(".", $newFile["name"]);
        // gets jpeg from xx xx jpeg
        $extension = strtolower(end($filenameStrArr)); // strtolower gets the string in all lower case
        // check the file type, only accept image/jpeg
        $allowedTypes = ["image/jpeg", "image/jpg"];
        $fileType = $newFile["type"];

        // check size is not more then 2000kb
        $maxFileSizeKB = 2000;
        $filesizeKB = $newFile["size"] / 1024;

        // extension of file is not inthe extension array
        if (in_array($extension, $allowedExts) &&
            in_array($extension, $allowedExts) &&
            ($filesizeKB <= $maxFileSizeKB)){

            $nowtime = time();
            $newFileName = "{$recordid}_{$nowtime}.{$extension}";
            $destFile = "{$folder}/{$newFileName}";
            
            if(move_uploaded_file($newFile["tmp_name"], $destFile)){
                $result = $newFileName;           
            }
        }
    }
    return "$result";
}
?>

