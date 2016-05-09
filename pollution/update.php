<?php
include 'connection.php';
include 'authentication.php';

/*$db_server["host"] = "localhost"; //database server
$db_server["username"] = "root"; // DB username
$db_server["password"] = ""; // DB password
$db_server["database"] = "pollution";// database name

$conn = mysqli_connect($db_server["host"], $db_server["username"], $db_server["password"], $db_server["database"]);
$conn->query ('SET CHARACTER SET utf8');
$conn->query ('SET COLLATION_CONNECTION=utf8_general_ci');
*/
$station_id = $_GET['station_id'];
$dirt_name = $_GET['dirt_name'];
$my_query = " UPDATE dirt SET name = '$dirt_name' where name is null  ";
$stationidquery = "UPDATE dirt SET station_id = '$station_id' where station_id is null";
$result = $conn->query($my_query);
$res = $conn->query($stationidquery);


$my= " SELECT * FROM DIRT ";//pws
$re = $conn->query($my);

if (!$result)
	die('Invalid query: ' . $conn->error);
else
	echo "Updated records: ".$conn->affected_rows;

echo "The last id: ".$conn->insert_id;

//$conn->close;

?>
