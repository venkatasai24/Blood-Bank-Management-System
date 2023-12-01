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
        echo '<div class="alert alert-danger alert-dismissible fade show text-center mx-auto" role="alert" style="width: fit-content;">';
        echo $error;
        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        ';
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
    <!-- Favicon -->
    <link rel="shortcut icon" href="../images/blood-drop.svg" type="image/x-icon">
    <!-- Apply custom styles for the form -->
    <style>
        html, body {
            min-height: 100%;
            margin: 0;
            padding: 0;
        }

        .navbar-nav .nav-item a , .dropdown a  {
            position: relative;
            color: #777;
            text-transform: uppercase;
            margin-right: 10px;
            text-decoration: none;
            overflow: hidden;
        }

        .dropdown-menu , .dropdown-menu a:hover {
            background-color: #f8f88f; /* Change the color to match your navbar background */
        }

        .navbar-nav  li a:hover {
            color: #1abc9c !important;
        }
    </style>
</head>
<body style="background-color: #f5f5dc;">
    <!-- Bootstrap navigation bar with responsive button -->
    <div class="container" style="margin-bottom: 100px;">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top navbar-shading" style="background-color:#f8f88f;">
    <!-- <nav class="navbar navbar-expand-lg navbar-light" style="background-color:#FF0000;"> -->
    <a class="navbar-brand" href="../index.php" style="color: #777;font-size:22px;letter-spacing:2px;">BBMS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="?home=1">Home</a>
                </li>                                       
                <li>
                    <?php
                    echo 
                    '
                    <div class="dropdown">
                        <a class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding-left:0px;">
                            '.$_SESSION['patient'].'
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li>
                                <a class="dropdown-item" href="?profile=1">Profile</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="?logout=1">Logout</a>
                            </li>
                        </ul>
                    </div>
                    ';
                    ?>
                </li>
            </ul>
        </div>
    </nav>
    </div>

    <?php

        if(isset($_GET))
        {
            if(count($_GET) > 1)
            {
                print_error("Link Corrupted!! Correct the link.......");
            }
            else
            {
                $getOne = key($_GET);
            }
        }
        
        if ($getOne && $getOne==='home')
        {

            if (!isset($_SESSION["welcome_patient_message"])) {
                // Display the welcome message
                echo '<div class="alert alert-success alert-dismissible fade show text-center mx-auto" role="alert" style="width: fit-content;">
                        Welcome, ' . $_SESSION["patient"]. '
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
    
                // Set a session variable to indicate that the welcome message has been displayed
                $_SESSION["welcome_patient_message"]=true;
            }
            
            $val = reset($_GET);

            if($val!=='1') 
            {
                print_error("Link Corrupted!! Correct the link.......");
                die();
            }

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
        else if ($getOne && $getOne==='profile')
        {

            $val = reset($_GET);

            if($val!=='1') 
            {
                print_error("Link Corrupted!! Correct the link.......");
                die();
            }

            check_profile_errors();

            $query = "SELECT * from patient where username=:username;";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":username",$_SESSION["patient"]);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            profile_template($row,"Patient");

        }
        else if ($getOne && $getOne==='request_blood')
        {

            $val = reset($_GET);

            if($val!=='1') 
            {
                print_error("Link Corrupted!! Correct the link.......");
                die();
            }

            check_errors();

            donate_request_template("request.php","Request Blood","Reason","reason","Request");

        }
        else if ($getOne && $getOne==='requests_history')
        {

            $val = reset($_GET);

            if($val!=='1') 
            {
                print_error("Link Corrupted!! Correct the link.......");
                die();
            }

            $query = "SELECT id from patient where username=:current_username;";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":current_username", $_SESSION['patient']);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $patient_id = $result["id"];

            $query = "SELECT * from request where patient_id=:id order by id desc;";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":id",$patient_id);
            $stmt->execute();

            $cnt=0;

            echo '<div class="container mt-5 mb-5">
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