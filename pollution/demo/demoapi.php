<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $_POST['xget']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$headers = array();
$headers[] = 'X-Api-Key: 098f6bcd4621d373cade4e832627b4f6';

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

echo curl_exec ($ch);
?>
