<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<title>Pollution Calculator | Admin Panel</title>
<link rel="shortcut icon" href="pol.jpg"> 
<link href="style.css" rel="stylesheet" type="text/css">

</head>
<?php

$db_server["host"] = "localhost"; //database server
$db_server["username"] = "root"; // DB username
$db_server["password"] = ""; // DB password
$db_server["database"] = "pollution";// database name

$mysql_con = mysqli_connect($db_server["host"], $db_server["username"], $db_server["password"], $db_server["database"]);
$mysql_con->query ('SET CHARACTER SET utf8');
$mysql_con->query ('SET COLLATION_CONNECTION=utf8_general_ci');


$id = $_POST['id']	;
$my_query = "DELETE from station WHERE id = '$id' ";//pws paizei 



$result = $mysql_con->query($my_query);

if (!$result)
	die('Invalid query: ' . $mysql_con->error);
else
	echo "Updated records: ".$mysql_con->affected_rows;
	
echo "<p><b>The last id: ".$mysql_con->insert_id."</b></p>";

//$mysql_con->close;

?>