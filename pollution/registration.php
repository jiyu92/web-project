<<?php
include 'connection.php';
/*$servername = "localhost";
$usernameDB = "root";
$passwordDB = "";
$dbname = "pollution";


// Create connection
$conn = mysqli_connect($servername, $usernameDB, $passwordDB, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
*/
//getting info for the registration
//$mail=$_GET['mail'];
//$password=$_GET['pass'];
//inserting the new user into the DB
$querry = "INSERT INTO user (username,password) VALUES ('".$_GET['mail']."','".$_GET['pass']."')";
$result=mysqli_query($conn,$querry);
if(!$result){
  echo "error";
}
//echo "all good";
echo $querry;
 ?>
