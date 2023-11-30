<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BBMS</title>
    <!-- Include Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Favicon -->
    <link rel="shortcut icon" href="images/blood-drop.svg" type="image/x-icon">
    <style>
    html {
        min-height: 100%;
        position: relative;
    }
    /* Add hover effect for links */
    .navbar-nav .nav-item a {
        position: relative;
        color: #777;
        margin-right:10px;
        text-decoration: none;
        overflow: hidden;
    }

    .navbar-nav  li a:hover {
        color: #1abc9c !important;
    }
    </style>
</head>
<body style="background-color: #f5f5dc;">
    <!-- Bootstrap navigation bar with responsive button -->
    <div class="container" style="margin-bottom: 50px;">
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color:#f8f88f;">
        <a class="navbar-brand" href="index.php" style="color: #777;font-size:22px;letter-spacing:2px;">BBMS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="patient/register.php">REGISTER</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="patient/login.php">LOGIN</a>
                </li>
            </ul>
        </div>
    </nav>
</div>

    <div class='container text-center' style="color:#000;padding-top: 100px;padding-bottom:50px;">
        <h1 class="display-6">Blood Bank Management System</h1>
        <div class="row align-items-center">
            <div class="col-lg-6">
                <p class="lead mt-3">
                    This system is designed to efficiently manage blood donations, donors, and recipients, ensuring the availability of safe and life-saving blood for those in need.
                </p>
                <p class="lead mt-3 mb-5">
                    Join us in the mission to save lives. Register as a donor or recipient and help make a difference!
                </p>
            </div>
            <div class="col-lg-6">
                <img id="animated-image" src="images/home.svg" alt="" class="img-fluid d-none d-lg-block">
            </div>
        </div>
    </div>



    <!-- Include Bootstrap JS and jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<footer class="footer" style="background-color:#1abc9c; color: #FFF; padding: 15px; text-align: center; position: absolute; bottom: 0; width: 100%;">
    <!-- Add content for your footer here -->
    &copy; <a style="color:#FFF;" href="https://github.com/venkatasai24">Venkatasai24</a> and <a style="color:#FFF;" href="https://github.com/venkatasai24/Blood-Bank-Management-System">Team</a> ❤️. All rights reserved. 2023 
</footer>
</html>
