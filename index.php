<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Getflix Homepage</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    <link rel="stylesheet" href="./css/style.css">
</head>
    <!-- navbar section   -->
    <header class="navbar-section">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><i class="bi bi-chat"></i>GETFLIX</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./home.php">Stream</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="signup.php">signup</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- hero section  -->

    <section id="home" class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 text-content p-5">
                    <h1>Stream unlimited trailers !</h1>
                    <h4>Do you love movies as much as we do?</h4>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 text-center">
                    <img src="../images/logo.png" alt="Getflix Logo" class="img-fluid" >
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