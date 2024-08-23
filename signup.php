<!-- Main PHP Section -->

<?php
session_start(); // Start the session

// Include the database connection
include 'connection.php';

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
        $password = $_POST['password']; // Do not hash here
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        if (!empty($username) && !empty($password) && !empty($email)) {
            // Validate email format
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = "Invalid email format";
                header("Location: signup.php");
                exit;
            }

            // Check if username already exists
            $sql = "SELECT COUNT(*) FROM users WHERE username = :username";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            if ($stmt->fetchColumn() > 0) {
                $_SESSION['error'] = "Username already exists.";
                header("Location: signup.php");
                exit;
            }

            // Check if email already exists
            $sql = "SELECT COUNT(*) FROM users WHERE email = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            if ($stmt->fetchColumn() > 0) {
                $_SESSION['error'] = "Email already exists.";
                header("Location: signup.php");
                exit;
            }

            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Insert user into database
            $sql = "INSERT INTO users (username, password, email) VALUES (:username, :password, :email)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':email', $email);

            if ($stmt->execute()) {
                // Set success message in session
                $_SESSION['signup_success'] = "Signup successful! You can now log in.";
                // Redirect to login.php and display the message
                header("Location: login.php");
                exit;
            } else {
                // Detailed error message
                echo "Error executing query: " . implode(", ", $stmt->errorInfo());
                header("Location: signup.php");
                exit;
            }
        } else {
            echo "All fields are required.";
        }
    } else {
        echo "Invalid form submission.";
    }
}
?>

<!-- HTML Section -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <title>Signup</title>
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
    <?php
    if (isset($_SESSION['signup_success'])) {
        echo "<p>" . $_SESSION['signup_success'] . "</p>";
        unset($_SESSION['signup_success']);
    }
    ?>

     <!-- hero section  -->


    <div id="home" class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-12 text-content p-5 mt-3">
                    <?php
                    if (isset($_SESSION['error'])) {
                        echo '<div class="message">' . $_SESSION['error'] . '</div>';
                        unset($_SESSION['error']);
                    }
                    ?>
                    <form method="post" action="signup.php">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                    <button type="submit">Signup</button>
                    </form>
                    <?php if (isset($_SESSION['signup_success'])): ?>
                            <p style="color: green;"><?php echo $_SESSION['signup_success']; unset($_SESSION['signup_success']); ?></p>
                    <?php endif; ?>
                </div>
                <div class="col-md-6 col-sm-12 text-center d-flex align-items-center justify-content-center">
                    <img src="./images/Logo.png" alt="Getflix Logo" class="img-fluid" >
                </div>
            </div>
        </div>
    </div>

    <!-- footer section  -->
    <footer>
                <div class="col text-center">
                    <a href="https://github.com/brieucdegoussencourt/GetFlix" target="_blank"><img
                    src="./images/github-icon-red.png" width="100" alt="github icon" class="github-icon"></a>
                    <h6 class="mt-3">brieucdegoussencourt / BeCode / July 2024</h6>
                </div>
    </footer>

    <!-- script section  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>
</body>
</html>