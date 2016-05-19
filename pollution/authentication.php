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
      $sql2 = "select * from api_requests where api_key_of_req='$value'";
      $result2 = mysqli_query($conn,$sql2);
      $result2 =mysqli_fetch_object($result2);
      $type = $_GET['action'];
      if(!$result2->{'api_key_of_req'}){
        $sql3 = "insert into api_requests (request_type,api_key_of_req,number_of_reqs) values ('$type','$value','1')";
      }
      else{
        $sql3 = "update api_requests set number_of_reqs = number_of_reqs + 1
        where request_type='$type'and api_key_of_req='$value'";
      }
      mysqli_query($conn,$sql3);
    }
  }

if(!$auth)
  exit("unauthorized");
?>
