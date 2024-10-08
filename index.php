<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
    content="Getflix is a streaming website to play movies and tv shows trailers using a search function">
    <title>Getflix Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
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
    <section id="home" class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-12 text-content p-5 d-flex align-items-center">
                    <h1>Stream unlimited trailers</h1>
                </div>
                <div class="col-md-6 col-sm-12 text-center">
                    <img src="./images/Logo.webp" alt="Getflix Logo" class="img-fluid" >
                </div>
            </div>
        </div>
    </section>

    <!-- footer section  -->
    <footer>
        <div class="container text-center">
            <div class="row text-center">
                <div class="col text-center">
                    <a href="https://github.com/brieucdegoussencourt/GetFlix" target="_blank"><img
                    src="./images/github-icon-red.png" width="100" alt="github icon" class="github-icon"></a>
                    <p class="mt-3">brieucdegoussencourt / BeCode / July 2024</p>
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