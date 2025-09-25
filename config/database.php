<?php

/**
 * Database Configuration
 * Update these settings according to your environment
 */

// Database configuration
$db_config = [
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'eventmanagement'
];

// Create connection
$conn = mysqli_connect(
    $db_config['host'],
    $db_config['username'],
    $db_config['password'],
    $db_config['database']
);

// Check connection
if (mysqli_connect_error()) {
    die("Failed to connect to database: " . mysqli_connect_error());
}

// Set charset to utf8 for proper character handling
mysqli_set_charset($conn, "utf8");
