<?php

/**
 * Database Configuration
 * Update these settings according to your environment
 */

require_once __DIR__ . '/../vendor/autoload.php';

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Database configuration
$db_config = [
    'host' => $_ENV['DB_HOST'],
    'username' => $_ENV['DB_USERNAME'],
    'password' => $_ENV['DB_PASSWORD'],
    'database' => $_ENV['DB_DATABASE']
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
