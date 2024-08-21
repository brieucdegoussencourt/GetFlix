<?php
// Include the database connection
include 'connection.php';

// Example of a signup form handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Debugging: Print the values to be inserted
    echo "Username: $username<br>";
    echo "Password Hash: $password<br>";

    // Insert user into database
    $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
        echo "Signup successful!";
        // Redirect to home.php
        header("Location: home.php");
        exit;
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Signup</title>
</head>
<body>
    <form method="post" action="signup.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Signup</button>
    </form>
</body>
</html>