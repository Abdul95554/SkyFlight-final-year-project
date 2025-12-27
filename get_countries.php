<?php
require_once 'db_connect.php';
header('Content-Type: application/json');

$result = $conn->query("SELECT id, name FROM countries ORDER BY name ASC");
$countries = [];

while ($row = $result->fetch_assoc()) {
  $countries[] = $row;
}

echo json_encode($countries);
?>
