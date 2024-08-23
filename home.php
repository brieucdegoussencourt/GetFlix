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

    <!-- navbar section   -->
    <header class="navbar-section">
        <nav class="navbar navbar-expand-sm">
            <div class="container-fluid"> 
                <a class="navbar-brand" href="index.php"><i class="bi bi-chat"></i>GETFLIX</a>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- hero section -->
    <section id="home" class="hero-section">
        <div class="container">
            <!-- Display user message -->
            <div class="name">
                <center>Welcome
                    <?php
                    echo $_SESSION['username'];
                    ?>
                    !
                </center>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12 text-content p-5">
                    <h1>Stream any movies & TV shows</h1>
                </div>
                <div class="col-md-6 col-sm-12 text-center d-flex align-items-center justify-content-center p-5">
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
            <!-- This is where the searched content will be displayed. -->
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
