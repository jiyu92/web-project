<?php
error_reporting(0);
if($_COOKIE['token']){
  $cookie = $_COOKIE['token'];
  $sql = "select * from user where token='$cookie'";
  $result = mysqli_query($conn,$sql);
  $result =mysqli_fetch_object($result);
  if($result->{'id'}){
    $auth=$result;
  }

}
if(!$auth)
  foreach (getallheaders() as $name => $value) {
    if($name!="X-Api-Key") continue;
    $sql= "select * from user where api_key = '$value'";
    $result = mysqli_query($conn,$sql);
    $result =mysqli_fetch_object($result);
    if($result->{'id'}){
      $auth=$result;
    }
  }

if(!$auth)
  exit("unauthorized");
?>
