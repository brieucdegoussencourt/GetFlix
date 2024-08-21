<?php
session_start(); // Start the session

// Include the database connection
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $password = $_POST['password'];

        if (!empty($username) && !empty($password)) {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Insert user into database
            $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $hashedPassword);

            if ($stmt->execute()) {
                // Set success message in session
                $_SESSION['signup_success'] = "Signup successful! You can now log in.";
                // Redirect to the same page to display the message
                header("Location: signup.php");
                exit;
            } else {
                // Detailed error message
                echo "Error executing query: " . implode(", ", $stmt->errorInfo());
            }
        } else {
            echo "Username and password cannot be empty.";
        }
    } else {
        echo "Invalid form submission.";
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