<?php
include 'connection.php';
error_reporting(0);
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
$response = array();
function generate_uuid() {
return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
	mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
	mt_rand( 0, 0xffff ),
	mt_rand( 0, 0x0fff ) | 0x4000,
	mt_rand( 0, 0x3fff ) | 0x8000,
	mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
);
}
$username=$_GET['mail'];
$password=$_GET['pass'];
$sql = "select username, password, is_admin, api_key from user where username='$username' and password='$password'";
$result=mysqli_query($conn,$sql);
$result =mysqli_fetch_object($result);
if(!$result->{'username'}){
$response["message"]="failed";
}
else{
	$uuid=generate_uuid();
	$up_querry = "update user set token='$uuid' where username='$username'";
	mysqli_query($conn,$up_querry);
	setcookie('token',$uuid,time() + (86400 * 7)); // 86400 = 1 day
	$response["message"]="success";
	$response["is_admin"]=$result->{'is_admin'};
	if(!$response["is_admin"])
		$response["api_key"]=$result->{'api_key'};
}
	//var_dump($response);
	echo json_encode($response);
?>
