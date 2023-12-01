<?php
    
    require_once("../includes/session.inc.php");
    require_once("../includes/template.php");
    if(isset($_SESSION["patient"]) && isset($_GET["register"]) && $_GET["register"]==="success")
    {
        header("Location:dashboard.php");
    }
    function check_errors()
    {
        if(isset($_SESSION["patient_error_register"]))
        {
            $errors = $_SESSION["patient_error_register"];
            echo "<br>";
            foreach ($errors as $error) {
                echo '<div class="alert alert-danger alert-dismissible fade show text-center mx-auto" role="alert" style="width: fit-content;">';
                echo $error;
                echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="background:none;">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
                ';
            }
            unset($_SESSION["patient_error_register"]);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Register</title>
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
        .form-container {
            border-radius: 10px;
            padding: 20px;
            margin: 10px auto 50px;
            max-width: 400px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .active , .active:hover {
            background-color: #1abc9c; /* Highlight color for the active button */
            color:#fff;
        }
        .btn {
            border: 1px #1ac9bc solid;
            margin: 5px;
        }
        .custom-text-center {
            padding: 10px;
            max-width: 400px;
            margin: auto;
        }
        @media (min-width: 576px) {
            .text-center {
                display: flex;
                justify-content: center;
            }
            .btn {
                flex: 1;
            }
        }
    </style>
</head>
<body style="background-color: #f5f5dc;">
    <div class="container" style="margin-top:80px;">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color:#f8f88f;">
        <a class="navbar-brand" href="../index.php" style="color: #777;font-size:22px;letter-spacing:2px;">BBMS</a>
    </nav>
        <?php 
            check_errors();
        ?>
        <div class="text-center custom-text-center">
            <a class="btn active" href="../patient/register.php">As Patient</a>
            <a class="btn" href="../donor/register.php">As Donor</a>
        </div>
        <!-- Patient Register Form -->
        <div style="display:block;">
            <?php register_template("Patient Register"); ?>
        </div>
    </div>
    <!-- Include Bootstrap JS and jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
