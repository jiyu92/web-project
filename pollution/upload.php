
<?php
include 'connection.php';
include 'authentication.php';
$target_dir = "C:\wamp\www\web-project\ ";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
if(isset($_POST["submit"])) {

        $uploadOk = 1;
    }

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
//parsing twn csv kai topothetsh dedomenwn sta swsta columns
$fieldseparator = ",";
$lineseparator = "\n";
$file= file_get_contents($target_file);
$rows= explode($lineseparator, $file);
foreach ($rows as $key => $row) {
  $fields = explode($fieldseparator, $row);
  $fields[0] = implode('',explode('"', $fields[0]));
  $dateshards = explode("-",$fields[0]);
  $newdate = $dateshards[2].'-'.$dateshards[1].'-'.$dateshards[0];
  $fields[0] = '"'.$newdate.'"';
  $qs = "insert into dirt (dmy,h1,h2,h3,h4,h5,h6,h7,h8,h9,h10,h11,h12,h13,h14,h15,h16,h17,h18,h19,h20,h21,h22,h23,h24) values (".implode(',',$fields).")";
  //echo $qs;
  if(count($fields)!=25)continue;
  mysqli_query($conn,$qs);
}

echo "Loaded a total of ".count($rows)." records from this csv file.\n";


    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
