<?php
$servername = "localhost";
$usernameDB = "root";
$passwordDB = "";
$dbname = "pollution";
// Create connection
$conn = mysqli_connect($servername, $usernameDB, $passwordDB, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
?>
