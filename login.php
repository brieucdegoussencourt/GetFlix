<!-- PHP Section -->

<?php
session_start();

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection
include 'connection.php';

// Login form handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch user from database
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Debugging: Print fetched user data
        echo "<pre>";
        print_r($user);
        echo "</pre>";

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            // Redirect to home.php
            header("Location: home.php");
            exit;
        } else {
            echo "Invalid username or password.";
        }
    } else {
        echo "Invalid username or password.";
    }
}
?>

<!-- HTML Section -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <title>Login</title>
</head>
<body>

    <!-- navbar section   -->
    <header class="navbar-section">
        <nav class="navbar navbar-expand-sm">
            <div class="container-fluid"> 
                    <a class="navbar-brand" href="index.php"><i class="bi bi-chat"></i>GETFLIX</a>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="home.php">Stream</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="signup.php">signup</a>
                        </li>
                    </ul>
            </div>
        </nav>
    </header>

     <!-- hero section  -->
     <section  class="hero-section">
        <div id="LoginForm">
            <form method="post" action="login.php">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <br>
                <button type="submit">Login</button>
            </form>
        </div>
    </section>

    <!-- footer section  -->
    <footer>
        <div class="container text-center">
            <div class="row text-center">
                <div class="col text-center">
                    <a href="https://github.com/brieucdegoussencourt/GetFlix" target="_blank"><img
                    src="./images/github-icon-red.png" width="100" alt="github icon" class="github-icon"></a>
                    <h6 class="mt-3">brieucdegoussencourt / BeCode / July 2024</h6>
                </div>
            </div>
        </div>
    </footer>

    <!-- script section  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>

</body>

</html>