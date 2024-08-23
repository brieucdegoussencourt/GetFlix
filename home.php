<?php
session_start();

// Include the database connection
include 'connection.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/stream_style.css">
    <link rel="stylesheet" href="./css/style.css">

    <title>Home</title>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="./index.php">GETFLIX</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <!-- User profile dropdown -->
                        <div class="dropdown">
                            <a class='nav-link dropdown-toggle' href='edit.php?id=<?php echo $res_id; ?>' id='dropdownMenuLink'
                               data-bs-toggle='dropdown' aria-expanded='false'>
                                <i class='bi bi-person'></i>
                            </a>
                            <ul class="dropdown-menu mt-2 mr-0" aria-labelledby="dropdownMenuLink">
                                <li>
                                    <?php
                                    // Fetch user details from the database
                                    $id = $_SESSION['id'];
                                    
                                    try {
                                        // Prepare and execute the query
                                        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
                                        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                                        $stmt->execute();

                                        // Fetch the result
                                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                        if ($result) {
                                            $res_username = $result['username'];
                                            $res_email = $result['email'];
                                            $res_id = $result['id'];
                                        } else {
                                            echo "User not found.";
                                        }
                                    } catch (PDOException $e) {
                                        echo "Error: " . $e->getMessage();
                                    }

                                    echo "<a class='dropdown-item' href='edit.php?id=$res_id'>Change Profile</a>";
                                    ?>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<!-- Display user message -->
<div class="name">
    <center>Welcome
        <?php
        echo $_SESSION['username'];
        ?>
        !
    </center>
</div>

<!-- hero section -->
<section id="home" class="hero-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 text-content p-5">
                <h1>Stream any movies & TV shows</h1>
                <form id="searchForm" onsubmit="searchData(event); return false;">
                    <input type="text" id="searchInput" placeholder="Search...">
                    <select id="mediaType">
                        <option value="movie">Movies</option>
                        <option value="tv">TV Shows</option>
                    </select>
                    <button type="submit">Search</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div id="content"></div>
        </div>
    </div>
</section>

<!-- footer section -->
<footer>
    <div class="container text-center">
        <div class="row text-center">
            <div class="col text-center">
                <a href="https://github.com/brieucdegoussencourt" target="_blank">
                    <img src="./images/github-icon-red.png" width="100" alt="github icon" class="github-icon">
                </a>
                <h6 class="mt-3">brieucdegoussencourt / BeCode / July 2024</h6>
            </div>
        </div>
    </div>
</footer>

<!-- script section -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
<script src="../frontend/app.js"></script>
</body>
</html>
