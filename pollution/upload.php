
<?php
$target_dir = "C:\wamp\www\pollution\ ";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

/*$db_server["host"] = "localhost"; //database server
$db_server["username"] = "root"; // DB username
$db_server["password"] = ""; // DB password
$db_server["database"] = "pollution";// database name

$mysql_con = mysqli_connect($db_server["host"], $db_server["username"], $db_server["password"], $db_server["database"]);
$mysql_con->query ('SET CHARACTER SET utf8');
$mysql_con->query ('SET COLLATION_CONNECTION=utf8_general_ci');
*/
// Check if image file is a actual image or fake image
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


$databasehost = "localhost";
$databasename = "pollution";
$databasetable = "dirt";
$databaseusername="root";
$databasepassword = "";
$fieldseparator = ",";
$lineseparator = "\n";
try {
    $pdo = new PDO("mysql:host=$databasehost;dbname=$databasename",
        $databaseusername, $databasepassword,
        array(
            PDO::MYSQL_ATTR_LOCAL_INFILE => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        )
    );
} catch (PDOException $e) {
    die("database connection failed: ".$e->getMessage());
}

$file= file_get_contents($target_file);
$rows= explode($lineseparator, $file);
foreach ($rows as $key => $row) {
  $fields = explode($fieldseparator, $row);
  $fields[0] = implode('',explode('"', $fields[0]));
  $dateshards = explode("-",$fields[0]);
  $newdate = $dateshards[2].'-'.$dateshards[1].'-'.$dateshards[0];
  $fields[0] = '"'.$newdate.'"';
  $qs = "insert into $databasetable (dmy,h1,h2,h3,h4,h5,h6,h7,h8,h9,h10,h11,h12,h13,h14,h15,h16,h17,h18,h19,h20,h21,h22,h23,h24) values (".implode(',',$fields).")";
  echo $qs;
  if(count($fields)!=25)continue;
  $pdo->exec($qs);
}

/*create new column for the sum of the day
$sqlexec= "select (h1";
for ($i=2; $i <=24 ; $i++) {
  $sqlexec.="+h$i";
}
$sqlexec .= ") from dirt";
$sum = $pdo->exec($sqlexec);
$sql = "update dirt set sum = '$sum' where sum is null";
$createcol = $pdo->exec($sql);

/*$affectedRows = $pdo->exec("
    LOAD DATA LOCAL INFILE ".$pdo->quote($target_file)." INTO TABLE $databasetable
      FIELDS TERMINATED BY ".$pdo->quote($fieldseparator)."
      LINES TERMINATED BY ".$pdo->quote($lineseparator));
*/
echo "Loaded a total of ".count($rows)." records from this csv file.\n";


    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
