<?php
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
	$servername = "localhost";
	$usernameDB = "root";
	$passwordDB = "";
	$dbname = "socialeventsdb";

	// Create connection
	$conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	mysqli_set_charset($conn, "utf8");
	// SQL query to fetch information of registerd users and finds user match.
	$sql = "select * from user where password='$password' AND username='$username'";
	$result_sql = $conn->query($sql);
	print_r ($result_sql);
	echo $sql;

if ($result_sql->num_rows == 1) {
$_SESSION['login_user']=$username; // Initializing Session
header("location: profile.php"); // Redirecting To Other Page
} else {
$error = "Username or Password is invalid";
}
//mysql_close($connection); // Closing Connection
$conn->close();
}
}
?>