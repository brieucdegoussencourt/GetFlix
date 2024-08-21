<?php
require 'vendor/autoload.php'; // Include Composer's autoloader

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

$db = parse_url($databaseUrl);

$dsn = sprintf(
    'pgsql:host=%s;port=%d;dbname=%s;user=%s;password=%s',
    $db['host'],
    $db['port'],
    ltrim($db['path'], '/'),
    $db['user'],
    $db['pass']
);

try {
    $pdo = new PDO($dsn, null, null, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    // Test the connection
    $stmt = $pdo->query("SELECT 1");
    if ($stmt !== false) {
        echo "Database connection successful.";
    } else {
        echo "Database connection failed.";
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}
?>