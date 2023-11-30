<?php
    
    
    require_once("../includes/session.inc.php");
    require_once("../includes/template.php");
    if(isset($_SESSION["admin"]) && isset($_GET["register"]) && $_GET["register"]==="success")
    {
        header("Location:dashboard.php");
    }
    function check_errors()
    {
        if(isset($_SESSION["admin_error_register"]))
        {
            $errors = $_SESSION["admin_error_register"];
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
            unset($_SESSION["admin_error_register"]);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Register</title>
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
        .navbar-shading {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4); /* Add a subtle box shadow for a lighting effect */
        }
    </style>
</head>
<body style="background-color: #f5f5dc;">
    <div class="container" style="margin-top:50px;">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top navbar-shading" style="background-color:#f8f88f;">
        <a class="navbar-brand" href="../index.php" style="color: #777;font-size:22px;letter-spacing:2px;">BBMS</a>
    </nav>
        <?php 
            check_errors();
            register_template("Admin Register");
        ?>
    </div>
    <!-- Include Bootstrap JS and jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
