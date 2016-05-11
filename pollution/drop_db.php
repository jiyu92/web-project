<?php
$servername = "localhost";
$usernameDB = "root";
$passwordDB = "";
$dbname = "pollution";
// Create connection
$conn = mysqli_connect($servername, $usernameDB, $passwordDB);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

  $sqldr="Drop database pollution";
  $drop = mysqli_query($conn,$sqldr);
  if($drop)
    echo "You have successfully deleted the database $dbname";
  else
    echo "You had one job...";




?>
