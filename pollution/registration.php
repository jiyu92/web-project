<<?php
include 'connection.php';
//creating random salt for each user
//make the registration with email and pass
$username = $_GET['mail'];
$querry = "INSERT INTO user (username,password) VALUES ('".$_GET['mail']."','".$_GET['pass']."')";
$result=mysqli_query($conn,$querry);
if(!$result){
  echo "error";
}
$salt = mt_rand();
$q_salt = "update user set salt='$salt' where username='$username'";
$res = mysqli_query($conn,$q_salt);
$res = mysqli_fetch_array($res);
//echo "$res";
if(!$res){
  printf("Error: %s\n", mysqli_errno($conn));
}

$api_key=md5($res[0].$username);
$md5q = "update user set api_key='$api_key' where username='$username'";
mysqli_query($conn,$md5q);
 ?>
