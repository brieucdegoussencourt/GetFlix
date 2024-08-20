<?php
// connection.php

$dsn = 'pgsql:host=c3l5o0rb2a6o4l.cluster-czz5s0kz4scl.eu-west-1.rds.amazonaws.com;port=5432;dbname=dd1nrhh4asd5js;user=ub503r7djq1bfj;password=p35df812fa54b039bac55e4ffc411820ba0f4a12f70009a2efc52857f26072ba4';

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