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
mysqli_set_charset($conn, "utf8");
?><meta http-equiv="content-type" content="text/html;charset=utf-8" /><?php
//create db automatically
$createq = file_get_contents('./database.txt', true);
$sqlScript = mb_convert_encoding($createq, 'UTF-8',
          mb_detect_encoding($createq, 'UTF-8, ISO-8859-1', true));

$shards = explode(';',implode('',explode("\r\n", $sqlScript)));

foreach ($shards as $key => $value) {
	if(!$value) continue;
	mysqli_query($conn, $value.';');
}

session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
$error = "Username or Password is invalid";
}
else
{
// Define $username and $password
$username=$_POST['username'];
$password=$_POST['password'];
//$error=$username." ".$password;
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
/*$connection = mysql_connect("localhost", "root", "");
// To protect MySQL injection for Security purpose
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);
// Selecting Database
$db = mysql_select_db("SocialEventsDB", $connection);*/

	// SQL query to fetch information of registerd users and finds user match.
	$sql = "select * from user where password='$password' AND username='$username'";
	$result_sql = $conn->query($sql);
	print_r ($result_sql);
	echo $sql;


	header("location: insert_utf.html");


}
//mysql_close($connection); // Closing Connection
$conn->close();
}

?>
