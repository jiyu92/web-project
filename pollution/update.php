<?php

$db_server["host"] = "localhost"; //database server
$db_server["username"] = "root"; // DB username
$db_server["password"] = ""; // DB password
$db_server["database"] = "pollution";// database name

$mysql_con = mysqli_connect($db_server["host"], $db_server["username"], $db_server["password"], $db_server["database"]);
$mysql_con->query ('SET CHARACTER SET utf8');
$mysql_con->query ('SET COLLATION_CONNECTION=utf8_general_ci');
$station_id = $_POST['station_id'];	
$dirt_name = $_POST['dirt_name'];		
$my_query = " UPDATE dirt SET name = '$dirt_name' where name is null  ";//pws paizei 
$stationidquery = "UPDATE dirt SET station_id = '$station_id' where station_id is null";
$result = $mysql_con->query($my_query);
$res = $mysql_con->query($stationidquery);


$my= " SELECT * FROM DIRT ";//pws 
$re = $mysql_con->query($my);

if (!$result)
	die('Invalid query: ' . $mysql_con->error);
else
	echo "Updated records: ".$mysql_con->affected_rows;
	
echo "<p><b>The last id: ".$mysql_con->insert_id."</b></p>";

//$mysql_con->close;

?>