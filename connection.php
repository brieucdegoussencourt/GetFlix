<?php

// Include Composer's autoloader
require 'vendor/autoload.php';

use Dotenv\Dotenv;

// Load .env file
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Retrieve the DATABASE_URL environment variable
$databaseUrl = getenv('DATABASE_URL');

if ($databaseUrl === false) {
    echo "Environment variable DATABASE_URL not set.";
    exit;
}

//Parse the DATABASE_URL into its components (host, port, dbname, user, password).
$db = parse_url($databaseUrl);

// Create the DSN (Data Source Name) string for the PDO connection
$dsn = sprintf(
    'pgsql:host=%s;port=%d;dbname=%s;user=%s;password=%s',
    $db['host'],
    $db['port'],
    ltrim($db['path'], '/'),
    $db['user'],
    $db['pass']
);

// Establish the PDO connection
try {
    // PDO (PHP Data Objects) is a database access layer providing a uniform method of access to multiple databases.
    // Here, we create a new PDO instance using the DSN and set error mode to exception.
    $pdo = new PDO($dsn, null, null, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    // If the connection fails, an exception is thrown and caught here.
    // The error message is displayed, and the script exits.
    echo "Connection failed: " . $e->getMessage();
    exit;
}
?>