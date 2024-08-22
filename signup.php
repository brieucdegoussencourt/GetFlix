<!-- Main PHP Section -->

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
        echo "Invalid input.";
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
     <section  class="hero-section">
        
          <form method="post" action="signup.php">
              <label for="username">Username:</label>
              <input type="text" id="username" name="username" required>
              <label for="password">Password:</label>
              <input type="password" id="password" name="password" required>
              <button type="submit">Signup</button>
          </form>
        
    </section>

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