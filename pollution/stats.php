<?php
include 'connection.php';
include 'authentication.php';
error_reporting(0);

$sql = "select request_type,number_of_reqs from api_requests";
$sql2 ="select api_key_of_req from api_requests order by 	number_of_reqs desc limit 10";
$sql3 ="select count(distinct api_key_of_req) from api_requests";
$result = mysqli_query($conn,$sql);
$result2 = mysqli_query($conn,$sql2);
$result3 = mysqli_query($conn,$sql3);
//$result = mysqli_fetch_object($result)

echo "[";
// print results, insert id or affected row count
for ($i=0;$i<mysqli_num_rows($result);$i++) {
    echo ($i>0?',':'').json_encode(mysqli_fetch_object($result));
    echo ($i>0?',':'').json_encode(mysqli_fetch_object($result2));
    echo ($i>0?',':'').json_encode(mysqli_fetch_object($result3));
  }
  echo "]";


?>