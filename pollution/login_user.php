<?php
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
$username=$_GET['mail'];
$password=$_GET['pass'];
$sql = "select username, password, is_admin from user where username='$username' and password='$password'";
$result=mysqli_query($conn,$sql);
if(!$result){
	echo "you entered wrong credentials or you're not registered";
}
else{
	echo $sql;
}
?>
