<?php
require_once("../includes/session.inc.php");
require_once("../includes/dbh.inc.php");
require_once("../includes/template.php");
    if (!isset($_SESSION["patient"])) {
        header("Location: login.php");
        die();
    }

    if (!isset($_GET['home']) && !isset($_GET["profile"]) && !isset($_GET["request_blood"]) && !isset($_GET["requests_history"]) && !isset($_GET["logout"])) {
        // Redirect to the same page with the 'blood' parameter added
        header('Location:dashboard.php?home=1');
    }

    if (isset($_GET["logout"])) {
        // Unset all session variables
        unset($_SESSION["patient"]);
        // Destroy the session
        session_destroy();
        header("Location:../index.php");
        die();
    }

    function print_error(string $error)
    {
        echo '<div style="text-align:center;color:#ff0000;" class="alert" role="alert">';
        echo $error;
        echo '</div>';
    }

    function check_errors()
    {
        if(isset($_SESSION["patient_error_request"]))
        {
            $errors = $_SESSION["patient_error_request"];
            foreach ($errors as $error) {
                print_error($error);
            }
            unset($_SESSION["patient_error_request"]);
        }
    }

    function check_profile_errors()
    {
        if(isset($_SESSION["patient_error_profile"]))
        {
            $errors = $_SESSION["patient_error_profile"];
            foreach ($errors as $error) {
                print_error($error);
            }
            unset($_SESSION["patient_error_profile"]);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard</title>
    <!-- Include Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Apply custom styles for the form -->
    <style>
        @media (min-width: 576px) {
        .navbar-nav .nav-item a {
            color: #FFF;
            transition: transform 0.3s; /* Smooth transition effect for scale */
        }
    
        .navbar-nav .nav-item a:hover {
            transform: scale(1.25); /* Increase font size on hover */
        }
    }
    </style>
</head>
<body>
    <!-- Bootstrap navigation bar with responsive button -->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color:#FF0000;">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="?home=1" style="color: #FFF; margin: 0 10px;">Home</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="?profile=1" style="color: #FFF; margin: 0 10px;">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?request_blood=1" style="color: #FFF; margin: 0 10px;">Request Blood</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?requests_history=1" style="color: #FFF; margin: 0 10px;">Request History</a>
                </li> -->
            </ul>
            <div class="ml-auto">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="?logout=1" style="color: #FFF;margin: 0 10px;">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php

        if(isset($_GET['home']))
        {
            $input = [
                "Patient",
                "Request",
                "Submit a request for blood donation.",
                "request",
                "Request",
                "View your past blood donation requests.",
                "requests"
            ];
            
            home_template($input);
            
        }
        
        if(isset($_GET['profile']))
        {
            check_profile_errors();

            $query = "SELECT * from patient where username=:username;";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":username",$_SESSION["patient"]);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            profile_template($row);

        }
    
        if(isset($_GET["request_blood"]))
        {

            check_errors();

            donate_request_template("request.php","Request Blood","Reason","reason","Request");

        }

        if(isset($_GET['requests_history']))
        {
            $query = "SELECT id from patient where username=:current_username;";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":current_username", $_SESSION['patient']);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $patient_id = $result["id"];

            $query = "SELECT * from request where patient_id=:id;";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":id",$patient_id);
            $stmt->execute();

            $cnt=0;

            echo '<div class="container mt-5">
                    <h2 class="text-center mb-4">Request History</h2>
                    <div class="row align-items-center">
                ';

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    history_template($row,"Reason","reason");

                $cnt++;
            }

            echo '</div>
            </div>';

            if($cnt==0) print_error("No requests history!");

            // Close the PDO connection
            $pdo = null;
        }

    ?>

    <!-- Include Bootstrap JS and jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>