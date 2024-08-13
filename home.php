<?php
// Start the session
session_start();

// Include the database connection file
include("connection.php");

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['username'])) {
    header("location:login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Getflix Stream</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/stream_style.css">
</head>
<body>

<!-- navbar section -->
<header class="navbar-section">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="./index.php"><i class="bi bi-chat"></i>GETFLIX</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <!-- User profile dropdown -->
                        <div class="dropdown">
                            <a class='nav-link dropdown-toggle' href='edit.php?id=$res_id' id='dropdownMenuLink'
                               data-bs-toggle='dropdown' aria-expanded='false'>
                                <i class='bi bi-person'></i>
                            </a>
                            <ul class="dropdown-menu mt-2 mr-0" aria-labelledby="dropdownMenuLink">
                                <li>
                                    <?php
                                    // Fetch user details from the database
                                    $id = $_SESSION['id'];
                                    $query = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");
                                    
                                    // Display user details
                                    while ($result = mysqli_fetch_assoc($query)) {
                                        $res_username = $result['username'];
                                        $res_email = $result['email'];
                                        $res_id = $result['id'];
                                    }

                                    echo "<a class='dropdown-item' href='edit.php?id=$res_id'>Change Profile</a>";
                                    ?>
                                </li>
                                <li><a class="dropdown-item" href="./index.php">Logout</a></li>
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
<script src="./frontend/app.js"></script>
</body>
</html>
