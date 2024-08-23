<?php
session_start();

// Include the database connection
include 'connection.php';

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
        // Log fetched user data
        error_log("Fetched user data: " . print_r($user, true));

        // Verify password
        $password_verified = password_verify($password, $user['password']);

        // Log password verification result
        error_log("Password verified: " . ($password_verified ? 'true' : 'false'));

        if ($password_verified) {
            // Password is correct, start a session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            error_log("Session started for user: " . $_SESSION['username']);
            header('Location: home.php'); // Redirect to home page
            exit;
        } else {
            $error = 'Invalid username or password.';
            error_log($error);
        }
    } else {
        $error = 'Invalid username or password.';
        error_log($error);
    }
}
?>

<!-- HTML Section -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
    content="Getflix is a streaming website to play movies and tv shows trailers using a search function">
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
    <div id="home" class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-12 text-content p-5 mt-3">
                    <?php if (isset($error)): ?>
                        <p class="message"><?php echo $error; ?></p>
                    <?php endif; ?>
                    <?php 
                    if (isset($_SESSION['signup_success'])) {
                        echo '<p class="message">' . $_SESSION['signup_success'] . '</p>';
                        unset($_SESSION['signup_success']);
                    }
                    ?>
                    <form method="post" action="login.php">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" required>
                        <br>
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                        <br>
                        <button type="submit">Login</button>
                    </form>
                </div>
                <div class="col-md-6 col-sm-12 text-center d-flex align-items-center justify-content-center">
                    <img src="./images/Logo.png" alt="Getflix Logo" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <!-- footer section  -->
    <footer>
                <div class="col text-center">
                    <a href="https://github.com/brieucdegoussencourt/GetFlix" target="_blank"><img
                    src="./images/github-icon-red.png" width="100" alt="github icon" class="github-icon"></a>
                    <p class="mt-3">brieucdegoussencourt / BeCode / July 2024</p>
                </div>
    </footer>

    <!-- script section  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>

</body>
</html>