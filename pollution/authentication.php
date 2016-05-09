<?php
if($_COOKIE['token']){
  $cookie = $_COOKIE['token'];
  $sql = "select id from user where token='$cookie'";
  $result = mysqli_query($conn,$sql);
  $result =mysqli_fetch_object($result);
  if($result->{'id'}){
    $auth=$result;
  }

}
if(!$auth)
  foreach (getallheaders() as $name => $value) {
      echo "$name: $value\n";
  }

if(!$auth)
  exit("unauthorized");
?>
