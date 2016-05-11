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

//create db automatically
$createq = file_get_contents('./database.sql', true);
$sqlScript = mb_convert_encoding($createq, 'UTF-8',
          mb_detect_encoding($createq, 'UTF-8, ISO-8859-1', true));

$shards = explode(';',implode('',explode("\r\n", $sqlScript)));

foreach ($shards as $key => $value) {
	if(!$value) continue;
	mysqli_query($conn, $value.';');
}
echo "Database $dbname created!";

?>
