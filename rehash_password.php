<?php
// Include the database connection
include 'connection.php';

// Rehash the password
$new_password = 'vian';
$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

// Update the password in the database for user 'boris'
$sql = "UPDATE users SET password = :password WHERE username = :username";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':password', $hashed_password);
$stmt->bindParam(':username', $username);
$stmt->execute();

echo "Password rehashed and updated successfully.";
?>