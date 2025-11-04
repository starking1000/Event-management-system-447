<?php
// Database/db.php
$host = '127.0.0.1';
$user = 'root';
$pass = '';
$db   = 'venuemanagement';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    error_log("DB connect error: " . $conn->connect_error);
    http_response_code(500);
    exit('Database connection error.');
}
$conn->set_charset('utf8mb4');
