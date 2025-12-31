<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "musafir_db";

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    // Only show error if page is not used as API
    header('Content-Type: application/json');
    http_response_code(500);
    echo json_encode(["error" => "Database connection failed."]);
    exit;
}
?>
