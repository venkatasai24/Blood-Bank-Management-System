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
    @media (min-width: 576px) {
        .navbar-nav .nav-item a {
            color: #FFF;
            transition: transform 0.3s; /* Smooth transition effect for scale */
        }
    
        .navbar-nav .nav-item a:hover {
            transform: scale(1.25); /* Increase font size on hover */
        }
    }
    #animated-image {
    margin-top: 50px;
    margin-bottom: 100px;
    height:200px;
    animation: scaleAnimation 0.4s infinite alternate; /* Animation duration and behavior */
    transform-origin: center; /* Sets the scaling center to the image center */
    }

    @keyframes scaleAnimation {
        0% {
            transform: scale(1); /* Start with the original size */
        }
        100% {
            transform: scale(1.25); /* End with 125% scaling */
        }
    }

    @media (max-width: 991px) {
        .navbar-nav.mr-auto {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-grow: 1;
        }
    }
    </style>
</head>
<body style="background: linear-gradient(45deg, #b6ffb6, #66b2ff);">
    <!-- Bootstrap navigation bar with responsive button -->
    <div class="container" style="margin-bottom: 50px;">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color:#b6ffb6;">
    <!-- <nav class="navbar navbar-expand-lg navbar-light" style="background-color:#ffb6b6;"> -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="patient/login.php" style="color: #333333; margin: 0 10px;">Patient</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="donor/login.php" style="color: #333333; margin: 0 10px;">Donor</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin/login.php" style="color: #333333;margin: 0 10px;">Doctor</a>
                </li>
            </ul>
        </div>
    </nav>
    </div>

    <div class='container text-center' style="color:#fff;padding-top: 100px;padding-bottom:50px;">
        <h1 class="display-6">Blood Bank Management System</h1>
        <p class="lead mt-3">
            This system is designed to efficiently manage blood donations, donors, and recipients, ensuring the availability of safe and life-saving blood for those in need.
        </p>
        <p class="lead mt-3">
            Join us in the mission to save lives. Register as a donor or recipient and help make a difference!
        </p>
        <img id="animated-image" src="images/plain.png" alt="">
    </div>



    <!-- Include Bootstrap JS and jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<footer class="footer" style="background-color: #66b2ff; color: #FFF; padding: 15px; text-align: center; position: absolute; bottom: 0; width: 100%;">
    <!-- Add content for your footer here -->
    &copy; <a style="color:#FFF;" href="https://github.com/venkatasai24">Venkatasai24</a> and Team. All rights reserved. 2023
</footer>
</html>
