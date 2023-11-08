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
    </style>
</head>
<body>
    <!-- Bootstrap navigation bar with responsive button -->
    <div class="container" style="margin-bottom: 50px;">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color:#FF0000;">
    <!-- <nav class="navbar navbar-expand-lg navbar-light" style="background-color:#FF0000;"> -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="patient/login.php" style="color: #FFF; margin: 0 10px;">Patient</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="donor/login.php" style="color: #FFF; margin: 0 10px;">Donor</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin/login.php" style="color: #FFF;margin: 0 10px;">Doctor</a>
                </li>
            </ul>
        </div>
    </nav>
    </div>

    <div class='container text-center' style="color: #ff0000; padding-top: 100px;">
        <h1 class="display-6">Blood Bank Management System</h1>
        <p class="lead mt-3">
            This system is designed to efficiently manage blood donations, donors, and recipients, ensuring the availability of safe and life-saving blood for those in need.
        </p>
        <p class="lead mt-3">
            Join us in the mission to save lives. Register as a donor or recipient and help make a difference!
        </p>
        <img id="animated-image" src="images/blood.png" alt="">
    </div>



    <!-- Include Bootstrap JS and jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
