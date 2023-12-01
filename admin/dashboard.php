<?php
    
    require_once("../includes/session.inc.php");
    require_once("../includes/dbh.inc.php");
    require_once("../includes/template.php");

    if (!isset($_SESSION["admin"])) {
        header("Location:login.php");
        die();
    }

    if (!isset($_GET['profile']) && !isset($_GET['stock']) && !isset($_GET["donors"]) && !isset($_GET["patients"]) && !isset($_GET["donations"]) && !isset($_GET["requests"]) && !isset($_GET["donations_history"]) && !isset($_GET["requests_history"]) && !isset($_GET["logout"])) {
        // Redirect to the same page with the 'blood' parameter added
        header('Location:dashboard.php?stock=1');
    }

    if (isset($_GET["logout"])) {
        // Unset session variable
        unset($_SESSION["admin"]);
        // Destroy the session
        header("Location:../index.php");
        die();
    }


    function check_errors()
    {
        if(isset($_SESSION["admin_error_update"]))
        {
            $errors = $_SESSION["admin_error_update"];
            foreach ($errors as $error) {
                print_error($error);
            }
            unset($_SESSION["admin_error_update"]);
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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

        .navbar-nav .nav-item a , .dropdown a {
            position: relative;
            color: #777;
            text-transform: uppercase;
            margin-right: 10px;
            text-decoration: none;
            overflow: hidden;
        }

        .navbar-nav  li a:hover {
            color: #1abc9c !important;
        }

        .dropdown-menu , .dropdown-menu a:hover {
            background-color: #f8f88f; /* Change the color to match your navbar background */
        }
        #animated-image {
        height:25px;
        margin-top: 20px;
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
<body style="background-color: #f5f5dc;">
    <!-- Bootstrap navigation bar with responsive button -->
    <div class="container" style="margin-bottom: 100px;">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color:#f8f88f;">
    <a class="navbar-brand" href="../index.php" style="color: #777;font-size:22px;letter-spacing:2px;">BBMS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="?stock=1">Stock</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?donors=1">Donors</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?patients=1">Patients</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?donations=1">Donations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?requests=1">Requests</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?donations_history=1">Donations History</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?requests_history=1">Requests History</a>
                </li>
                <li>
                    <?php
                    echo 
                    '
                    <div class="dropdown">
                        <a class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding-left:0px;">
                            '.$_SESSION['admin'].'
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
    
    
        function blood_group(int $name,string $val)
        {
            $blood_map = [
                "AP" => "A+",
                "AN" => "A-",
                "BP" => "B+",
                "BN" => "B-",
                "ABP" => "AB+",
                "ABN" => "AB-",
                "OP" => "O+",
                "ON" => "O-",
            ];

            echo 
            '
                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="text-center">
                    <img id="animated-image" src="../images/blood-drop.svg" alt="">
                    <p class="mt-2">'.$blood_map[$val].'</p>
                    <p class="mt-2">' . $name . '</p>
                    </div>
                </div>
            ';
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

        function check_profile_errors()
        {
            if(isset($_SESSION["admin_error_profile"]))
            {
                $errors = $_SESSION["admin_error_profile"];
                foreach ($errors as $error) {
                    print_error($error);
                }
                unset($_SESSION["admin_error_profile"]);
            }
        }

        function print_details(array $row,string $type)
        {
            echo
            '
            <style>
            .transparent-bg {
                transition: background 0.3s, transform 0.3s;
                border-radius:16px;
                color:#fff;
            }
            
            .transparent-bg:hover {
                transform: translateY(-5px); /* Scale up the card on hover */
            }                       
            </style>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4"> 
                <div class="card transparent-bg" style="background:#1abc9c;border:none;border-radius:16px;">
                    <div class="card-body">
            ';
            echo '<b><p class="card-title">' . $row['username'] . '</p></b>';
            echo '<p class="card-text">Id : ' . $row['id'] . '</p>';
            echo '<p class="card-text">Name : ' . $row['name'] . '</p>';
            echo '<p class="card-text">Email : ' . $row['email'] . '</p>';
            echo '<p class="card-text">Blood Group : ' . $row['blood'] . '</p>';
            echo '
            <form method="post" action="delete.php">
                <input type="hidden" name="id" value="' . $row['id'] . '">
                <button class="btn" type="submit" name='.$type.'><i class="fa fa-trash" aria-hidden="true"></i></button>
            </form>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }

        function requests_donations_details(array $row,string $path,string $name1,string $name2)
        {
            echo
            '
            <style>
            .transparent-bg {
                transition: background 0.3s, transform 0.3s;
                border-radius:16px;
                color:#fff;
            }
            
            .transparent-bg:hover {
                transform: scale(1.05); /* Scale up the card on hover */
            }                       
            </style>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4"> 
                <div class="card transparent-bg" style="background:#1abc9c;border:none;border-radius:16px;">
                    <div class="card-body">
                        <b><p class="card-title">' . $row['username'] . '</p></b>
                        <p class="card-text">'.$name1.' : ' . $row[$name2] . '</p>
                        <p class="card-text">Blood Group : ' . $row['blood'] . '</p>
                        <p class="card-text">Units : ' . $row['unit'] . '</p>
                        <form method="post" action='.$path.'>
                            <input type="hidden" name="id" value="' . $row['id'] . '">
                            <button class="btn" type="submit" name="approve"><i class="fa fa-check" aria-hidden="true"></i></button>
                            <button style="margin-left:20px;" class="btn" type="submit" name="reject"><i class="fa fa-times" aria-hidden="true"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            ';
        }

        function history(array $row,string $name1,string $name2,string $name3)
        {
            echo
            '
            <style>
            .transparent-bg {
                transition: background 0.3s, transform 0.3s;
                border-radius:16px;
                color:#fff;
            }
            
            .transparent-bg:hover {
                transform: scale(1.05); /* Scale up the card on hover */
            }                       
            </style>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4"> 
                <div class="card transparent-bg" style="background:#1abc9c;border:none;border-radius:16px;">
                    <div class="card-body">
                        <b><p class="card-title">Id : ' . $row[$name1] . '</p></b>
                        <p class="card-text">'.$name2.' : ' . $row[$name3] . '</p>
                        <p class="card-text">Blood Group : ' . $row['blood'] . '</p>
                        <p class="card-text">Units : ' . $row['unit'] . '</p>
                        <b><p class="card-text">' . $row['status'] . '</p></b>
                    </div>
                </div>
            </div>
            ';
        }

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

        if ($getOne && $getOne==='profile')
        {

            $val = reset($_GET);

            if($val!=='1') 
            {
                print_error("Link Corrupted!! Correct the link.......");
                die();
            }

            check_profile_errors();
            
            $query = "SELECT * from admin where username=:username;";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":username",$_SESSION["admin"]);
            $stmt->execute();
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            profile_template($row,'Admin');

        }
        else if ($getOne && $getOne==='stock')
        {

            if (!isset($_SESSION["welcome_admin_message"])) {
                // Display the welcome message
                echo '<div class="alert alert-success alert-dismissible fade show text-center mx-auto" role="alert" style="width: fit-content;">
                        Welcome, ' . $_SESSION["admin"]. '
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
    
                // Set a session variable to indicate that the welcome message has been displayed
                $_SESSION["welcome_admin_message"]=true;
            }
            
            $val = reset($_GET);

            if($val!=='1') 
            {
                print_error("Link Corrupted!! Correct the link.......");
                die();
            }

            check_errors();
            
            $id=1;
            $query = "SELECT * from blood where id=:id;";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":id",$id);
            $stmt->execute();
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            
            
            echo '
            <div class="container">
            <div class="row" style="margin-top:50px;">';
            blood_group($row["AP"],"AP");
            blood_group($row["AN"],'AN');
            blood_group($row["BP"],"BP");
            blood_group($row["BN"],"BN");
            blood_group($row["ABP"],"ABP");
            blood_group($row["ABN"],"ABN");
            blood_group($row["OP"],"OP");
            blood_group($row["ON"],"ON");
            echo '</div>
            <div class="row">
                <div class="col-md-4 offset-md-4 mt-5 mb-5">
                            <div class="form-container">
                            <h2 class="text-center">Update Blood</h2>
                            <form action="update.php" method="post">
                                <div class="form-group">
                                    <select class="form-control" name="blood">
                                        <option value="">Select blood group</option>
                                        <option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                        <option value="B+">B+</option>
                                        <option value="B-">B-</option>
                                        <option value="O+">O+</option>
                                        <option value="O-">O-</option>
                                        <option value="AB+">AB+</option>
                                        <option value="AB-">AB-</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="number" name="unit" class="form-control mt-2" placeholder="Quantity">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn" name="button" style="color:#fff;background-color:#0047ab;">Update</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                    </div>
            ';


        }
        else if ($getOne && $getOne==='donors')
        {

            $val = reset($_GET);

            if($val!=='1') 
            {
                print_error("Link Corrupted!! Correct the link.......");
                die();
            }
            
            $query = "SELECT * from donor;";
            $stmt = $pdo->prepare($query);
            $stmt->execute();

            $cnt=0;

            // Table header
            echo '<div class="container mt-5 mb-5">'; // Add Bootstrap container
            echo '<div class="row align-items-center">';

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Process each donor and display as a card
                print_details($row,"donor");
                $cnt++;
            }

            echo '</div>';
            echo '</div>';

            if($cnt==0) print_error("No donors!");

            // Close the PDO connection
            $pdo = null;
            
        }
        else if ($getOne && $getOne==='patients')
        {

            $val = reset($_GET);

            if($val!=='1') 
            {
                print_error("Link Corrupted!! Correct the link.......");
                die();
            }

            $query = "SELECT * from patient;";
            $stmt = $pdo->prepare($query);
            $stmt->execute();

            $cnt=0;

            echo '<div class="container mt-5 mb-5">'; // Add Bootstrap container
            echo '<div class="row align-items-center">';

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Process each donor and display as a card
                print_details($row,"patient");
                $cnt++;
            }

            echo '</div>';
            echo '</div>';

            if($cnt==0) print_error("No patients!");

            // Close the PDO connection
            $pdo = null;
        }
        else if ($getOne && $getOne==='requests')
        {

            $val = reset($_GET);

            if($val!=='1') 
            {
                print_error("Link Corrupted!! Correct the link.......");
                die();
            }

            $status = "pending";
            $query = "SELECT * from request where status=:status order by id desc;";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":status",$status);
            $stmt->execute();

            $cnt=0;

            echo '<div class="container mt-5 mb-5">
                    <div class="row align-items-center">';

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                requests_donations_details($row,"request.php","Reason","reason");

                $cnt++;
            }

            echo '</div>
            </div>';

            if($cnt==0) print_error("No requests made currently!");

            // Close the PDO connection
            $pdo = null;
            
        }
        else if ($getOne && $getOne==='donations')
        {

            $val = reset($_GET);

            if($val!=='1') 
            {
                print_error("Link Corrupted!! Correct the link.......");
                die();
            }

            $status = "pending";
            $query = "SELECT * from donate where status=:status order by id desc;";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":status",$status);
            $stmt->execute();

            $cnt=0;

            echo '<div class="container mt-5 mb-5">
                    <div class="row align-items-center">';


            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                requests_donations_details($row,"donate.php","Disease","disease");

                $cnt++;
            }

            echo '</div>
            </div>';

            if($cnt==0) print_error("No donations made currently!");

            // Close the PDO connection
            $pdo = null;
        }
        else if ($getOne && $getOne==='requests_history')
        {

            $val = reset($_GET);

            if($val!=='1') 
            {
                print_error("Link Corrupted!! Correct the link.......");
                die();
            }

            $status = "pending";
            $query = "SELECT * from request where status!=:status order by id desc;";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":status",$status);
            $stmt->execute();

            $cnt=0;

            echo '<div class="container mt-5 mb-5">
                    <div class="row align-items-center">';

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                history($row,"patient_id","Reason","reason");

                $cnt++;
            }

            echo '</div>
            </div>';

            if($cnt==0) print_error("No requests history!");

            // Close the PDO connection
            $pdo = null;
            
        }
        else if ($getOne && $getOne==='donations_history')
        {

            $val = reset($_GET);

            if($val!=='1') 
            {
                print_error("Link Corrupted!! Correct the link.......");
                die();
            }

            $status = "pending";
            $query = "SELECT * from donate where status!=:status order by id desc;";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":status",$status);
            $stmt->execute();

            $cnt=0;

            echo '<div class="container mt-5 mb-5">
                    <div class="row align-items-center">';

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                history($row,"donor_id","Disease","disease");

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
