<?php
if($_COOKIE['token']){
  $sql = "select id from user where token='$_COOKIE['token']'";
  $result = mysqli_query($conn,$sql);
  if($result){
    $auth=$result;
  }

}
if(!$auth)
  foreach (getallheaders() as $name => $value) {
      echo "$name: $value\n";
  }
setcookie('session_token',$token,time() + (86400 * 7)); // 86400 = 1 day
$_COOKIE['token']

?>
