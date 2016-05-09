<?php
include 'connection.php';
include 'authentication.php';

/*$db_server["host"] = "localhost"; //database server
$db_server["username"] = "root"; // DB username
$db_server["password"] = ""; // DB password
$db_server["database"] = "pollution";// database name

$mysql_con = mysqli_connect($db_server["host"], $db_server["username"], $db_server["password"], $db_server["database"]);
$mysql_con->query ('SET CHARACTER SET utf8');
$mysql_con->query ('SET COLLATION_CONNECTION=utf8_general_ci');
*/
$my_query = "INSERT into station (name,id,location) VALUES ('".$_GET['name']."','".$_GET['id']."','".$_GET['location']."')";

$result = $conn->query($my_query);

if (!$result)
	die('Invalid query: ' . $conn->error);
else
	echo "Add station";


//$mysql_con->close;

?>
