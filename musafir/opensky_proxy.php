<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$url = "https://opensky-network.org/api/states/all";
$data = file_get_contents($url);
echo $data;
?>
