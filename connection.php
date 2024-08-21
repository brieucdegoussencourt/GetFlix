<?php
// connection.php

require 'vendor/autoload.php';

use Dotenv\Dotenv;

// Load environment variables from .env file
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Get the database URL from the environment variable
$dbUrl = getenv('DATABASE_URL');

if ($dbUrl === false) {
    die('Environment variable DATABASE_URL not set.');
}

// Parse the URL to get the components
$dbopts = parse_url($dbUrl);

$dsn = 'pgsql:host=' . $dbopts["host"] . ';port=' . $dbopts["port"] . ';dbname=' . ltrim($dbopts["path"],'/') . ';user=' . $dbopts["user"] . ';password=' . $dbopts["pass"];

try {
    // Create a new PDO instance
    $pdo = new PDO($dsn);
    // Set error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Execute a simple query to check the connection
    $stmt = $pdo->query('SELECT 1');
    if ($stmt) {
        echo 'Connection successful!';
    }
} catch (PDOException $e) {
    // Handle connection error
    echo 'Connection failed: ' . $e->getMessage();
}
?>