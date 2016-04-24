<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "pollution";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	mysqli_set_charset($conn, "utf8");
	
	session_start();// Starting Session
	// Storing Session
	$user_check=$_SESSION['login_user'];
	// SQL Query To Fetch Complete Information Of User
	$ses_sql="select username from user where username='$user_check'";
	$result_sql = $conn->query($ses_sql);
	$row = $result_sql->fetch_assoc();
	$login_session =$row['username'];
	if(!isset($login_session)){
	$conn->close(); // Closing Connection
	
	}
?>