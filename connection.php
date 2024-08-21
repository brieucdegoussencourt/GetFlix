<?php
// Database connection using environment variables
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
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}
?>