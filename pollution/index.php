<?php
include('login.php'); // Includes Login Script

if(isset($_SESSION['login_user'])){
header("location: insert_utf.html");
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<title>Pollution Calculator | Admin Panel</title>
<link rel="shortcut icon" href="icon.jpg"> 
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="main">
<img id="adminPic" src="admin.jpg"  style="width:25%;height:7%;">
<!--<h1>Σελίδα Διαχειριστή</h1>-->
<div id="login">
<h2>Φόρμα Εισόδου</h2>
<form action="" method="post">
<label>UserName :</label>
<input id="name" name="username" placeholder="username" type="text">
<label>Password :</label>
<input id="password" name="password" placeholder="**********" type="password">
<input name="submit" type="submit" value=" Login ">
<span><?php echo $error; ?></span>
</form>
</div>
</div>
</body>
</html>