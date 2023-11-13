<?php

    
    require_once("../includes/session.inc.php");
    require_once("../includes/template.php");
    if(isset($_SESSION["donor"]) && isset($_GET["login"]) && $_GET["login"]==="success")
    {
        header("Location:dashboard.php");
    }
    function check_errors()
    {
        if(isset($_SESSION["donor_error_login"]))
        {
            $errors = $_SESSION["donor_error_login"];
            echo "<br>";
            foreach ($errors as $error) {
                echo '<div class="alert alert-light" style="color:#ff0000;" role="alert">';
                echo $error;
                echo '</div>';
            }
            unset($_SESSION["donor_error_login"]);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Login</title>
    <!-- Include Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
        .form-container {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            margin: 50px auto;
            max-width: 400px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php 
            check_errors();
            login_template("login.inc.php","Donor Login","<p class='text-center mt-3'>Don't have an account? <a href='register.php'>Register here</a></p>");
        ?>
    </div>
    <!-- Include Bootstrap JS and jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
