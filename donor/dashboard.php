<?php
    
    require_once("../includes/session.inc.php");
    require_once("../includes/dbh.inc.php");
    require_once("../includes/template.php");
    if (!isset($_SESSION["donor"])) {
        header("Location: login.php");
        die();
    }

    if (!isset($_GET['home']) && !isset($_GET["profile"]) && !isset($_GET["donate_blood"]) && !isset($_GET["donations_history"]) && !isset($_GET["logout"])) {
        // Redirect to the same page with the 'blood' parameter added
        header('Location:dashboard.php?home=1');
    }

    if (isset($_GET["logout"])) {
        // Unset all session variables
        unset($_SESSION["donor"]);
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
        if(isset($_SESSION["donor_error_donate"]))
        {
            $errors = $_SESSION["donor_error_donate"];
            foreach ($errors as $error) {
                print_error($error);
            }
            unset($_SESSION["donor_error_donate"]);
        }
    }

    function check_profile_errors()
    {
        if(isset($_SESSION["donor_error_profile"]))
        {
            $errors = $_SESSION["donor_error_profile"];
            foreach ($errors as $error) {
                print_error($error);
            }
            unset($_SESSION["donor_error_profile"]);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Dashboard</title>
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

        body {
            background: linear-gradient(45deg, #b6ffb6, #66b2ff);
        }

        .navbar-nav .nav-item a {
            color:#333333;
            transition: transform 0.3s; /* Smooth transition effect for scale */
        }
    
        .navbar-nav .nav-item a:hover {
            transform: scale(1.25); /* Increase font size on hover */
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
<body>
    <!-- Bootstrap navigation bar with responsive button -->
    <div class="container" style="margin-bottom: 100px;">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color:#b6ffb6;">
    <!-- <nav class="navbar navbar-expand-lg navbar-light" style="background-color:#FF0000;"> -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php" style="color:#333333; margin: 0 10px;">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?logout=1" style="color:#333333;margin: 0 10px;">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    </div>

    <?php

        if(isset($_GET['home']))
        {
            
            $input = [
                "Donor",
                "Donate",
                "Make a new blood donation appointment.",
                "donate",
                "Donation",
                "View your past blood donation records.",
                "donations"
            ];
            
            home_template($input);

        }
        
        if(isset($_GET['profile']))
        {
            check_profile_errors();

            $query = "SELECT * from donor where username=:username;";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":username",$_SESSION["donor"]);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            profile_template($row);
        }
    
        if(isset($_GET["donate_blood"]))
        {

            check_errors();

            donate_request_template("donate.php","Donate Blood","Disease","disease","Donate");

        }

        if(isset($_GET['donations_history']))
        {
            $query = "SELECT id from donor where username=:current_username;";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":current_username", $_SESSION['donor']);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $donor_id = $result["id"];
            
            $query = "SELECT * from donate where donor_id=:id;";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":id",$donor_id);
            $stmt->execute();

            $cnt=0;

            echo '<div class="container mt-5 mb-5">
                    <h2 class="text-center mb-4">Donation History</h2>
                    <div class="row align-items-center">';

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                history_template($row,"Disease","disease");

                $cnt++;
            }

            echo '</div>
            </div>';

            if($cnt==0) print_error("No donations history!");

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