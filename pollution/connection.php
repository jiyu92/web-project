<?php
$servername = "localhost";
$usernameDB = "root";
$passwordDB = "";
$dbname = "pollution";
// Create connection
$conn = mysqli_connect($servername, $usernameDB, $passwordDB, $dbname);
//making greek acceptable by the db with the utf-8 encoding
$q1="SET NAMES 'utf8'";
$q2="SET CHARACTER SET 'utf8'";
mysqli_query($conn,$q1);
mysqli_query($conn,$q2);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
?>
