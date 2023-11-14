<?php
    function login_template(string $name)
    {
        echo
        '
        <style>
            .form-group .user-box {
                position: relative;
                margin: 30px 0px;
            }
            .form-group .user-box input {
                width: 100%;
                padding: 10px 0;
                font-size: 16px;
                color: #000;
                border: none;
                border-bottom: 1px solid #000;
                background: transparent;
                border-radius: 0; 
                outline: none;
            }
            .form-group .user-box label {
                position: absolute;
                top: 0;
                left: 0;
                padding: 10px 0;
                font-size: 16px;
                color: #000;
                pointer-events: none;
                transition: .5s;
            }
            .form-group .user-box input:focus ~ label,
            .form-group .user-box input:valid ~ label {
                top: -30px;
                left: 0;
                color: #000;
                font-size: 12px;
            }
            .form-group .user-box input:focus ~ label,
            .form-group .user-box input:valid ~ label,
            .form-group .user-box input:active ~ label {
                color: #000;
                font-size: 12px;
                top: -30px;
                left: 0;
            }
            button {
                position: relative;
                display: inline-block;
                padding: 10px 20px;
                font-weight: bold;
                color: #fff;
                font-size: 16px;
                text-decoration: none;
                text-transform: uppercase !important;
                overflow: hidden;
                transition: background 0.3s, color 0.3s, border-radius 0.3s;
                letter-spacing: 1px;
                background: linear-gradient(45deg, #b6ffb6, #66b2ff); /* Button background color */
                border: none; /* Button border color */
            }
            button:hover {
                border-radius: 25px; /* Button border-radius on hover */
            }
        </style>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="form-container">
                    <div class="d-flex justify-content-between">
                        <h2 class="text-center">' . $name . '</h2>
                        <a href="../index.php" class="btn"><i style="font-size:25px;" class="fa fa-home"></i></a>
                    </div>
                    <form action="login.inc.php" method="post">
                        <div class="form-group">
                            <div class="user-box">
                                <input type="text" class="form-control" name="username" required>
                                <label>Username</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="user-box">
                                <input type="password" class="form-control" name="pwd" required>
                                <label>Password</label>
                            </div>
                        </div>
                        <button type="submit">Login</button>
                    </form>
                    <p class="mt-3">Dont have an account? <a href="register.php">Register here</a></p>
                </div>
            </div>
        </div>
        ';
    }

    function register_template(string $name)
    {
        echo
        '
        <style>
            .form-group .user-box {
                position: relative;
                margin: 30px 0px;
            }
            .form-group .user-box input {
                width: 100%;
                padding: 10px 0;
                font-size: 16px;
                color: #000;
                border: none;
                border-bottom: 1px solid #000;
                background: transparent;
                border-radius: 0; 
                outline: none;
            }
            .form-group .user-box label {
                position: absolute;
                top: 0;
                left: 0;
                padding: 10px 0;
                font-size: 16px;
                color: #000;
                pointer-events: none;
                transition: .5s;
            }
            .form-group .user-box input:focus ~ label,
            .form-group .user-box input:valid ~ label {
                top: -30px;
                left: 0;
                color: #000;
                font-size: 12px;
            }
            .form-group .user-box input:focus ~ label,
            .form-group .user-box input:valid ~ label,
            .form-group .user-box input:active ~ label {
                color: #000;
                font-size: 12px;
                top: -30px;
                left: 0;
            }
            button {
                position: relative;
                display: inline-block;
                padding: 10px 20px;
                font-weight: bold;
                color: #fff;
                font-size: 16px;
                text-decoration: none;
                text-transform: uppercase !important;
                overflow: hidden;
                transition: background 0.3s, color 0.3s, border-radius 0.3s;
                letter-spacing: 1px;
                background: linear-gradient(45deg, #b6ffb6, #66b2ff); /* Button background color */
                border: none; /* Button border color */
            }
            button:hover {
                border-radius: 25px; /* Button border-radius on hover */
            }
        </style>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="form-container">
                    <div class="d-flex justify-content-between">
                        <h2 class="text-center">' . $name . '</h2>
                        <a href="../index.php" class="btn"><i style="font-size:25px;" class="fa fa-home"></i></a>
                    </div>
                    <form action="register.inc.php" method="post">
                        <div class="form-group">
                            <div class="user-box">
                                <input type="text" class="form-control" name="name" required>
                                <label>Name</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="user-box">
                                <input type="email" class="form-control" name="email" required>
                                <label>Email</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="user-box">
                                <input type="text" class="form-control" name="username" required>
                                <label>Username</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="user-box">
                                <input type="password" class="form-control" name="pwd" required>
                                <label>Password</label>
                            </div>
                        </div>';

                        if ($name !== "Admin Register") {
                            echo
                            '<div class="form-group">
                                <div class="user-box">
                                    <select class="form-control" name="blood" required>
                                        <option value="">Select your blood group</option>
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
                            </div>';
                        }

                        echo
                        '<!-- Add more registration fields as needed -->
                        <button type="submit">Register</button>
                    </form>
                    <p class="mt-3">Already have an account? <a href="login.php">Login here</a></p>
                </div>
            </div>
        </div>
        ';
    }
    function profile_template(array $row)
    {
        echo
        '
        <div class="container">
            <div class="row">
                <div class="col-md-4 offset-md-4 mt-5">
                    <div class="form-container">
                    <h2 class="text-center">Profile</h2>
                    <form action="update_delete.php" method="post">
                        <div class="form-group">
                            <label for="id">Id</label>
                            <input type="text" class="form-control" name="id" value='.$row['id'].' readonly>
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" value='.$row['name'].'>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" value='.$row['email'].'>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" value='.$row['username'].'>
                        </div>
                        <div class="form-group">
                            <label for="bloodgroup">Blood Group</label>
                            <input type="text" class="form-control" name="blood" value='.$row['blood'].' readonly>
                        </div>
                        <div class="text-center"> <!-- Center the buttons -->
                            <button type="submit"  name="update" class="btn btn-primary">Update</button>
                            <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
            </div>
        ';
    }

    function donate_request_template(string $path,string $name,string $name1,string $name2,string $name3)
    {
        echo 
        '
        <div class="container">
            <div class="row">
                <div class="col-md-4 offset-md-4 mt-5">
                    <div class="form-container">
                    <h2 class="text-center">'.$name.'</h2>
                    <form action='.$path.' method="post">
                        <div class="form-group">
                            <label for='.$name2.'>'.$name1.':</label>
                            <input type="text" id='.$name2.' name='.$name2.' class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="units">Units:</label>
                            <input type="number" id="units" name="unit" class="form-control">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">'.$name3.'</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
            </div>
        ';
    }
    function history_template(array $row,string $name1,string $name2)
    {
        echo
        '
        <style>
        .transparent-bg {
            background: #b6ffb6;
            transition: background 0.3s, transform 0.3s;
            border: 1px solid #66b2ff;
            border-radius:16px;
        }
        
        .transparent-bg:hover {
            transform: scale(1.05); /* Scale up the card on hover */
        }                       
        </style>
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4"> 
            <div class="card" style="box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);border: 1px solid #66b2ff;border-radius:16px;">
                <div class="card-body transparent-bg">
                    <p class="card-text">'.$name1.' : ' . $row[$name2] . '</p>
                    <p class="card-text">Units : ' . $row['unit'] . '</p>
                    <b><p class="card-text">' . $row['status'] . '</p></b>
                </div>
            </div>
        </div>
        ';
    }

    function home_template(array $name)
    {
        echo 
        '
        <style>
        .transparent-bg {
            background: #b6ffb6;
            transition: background 0.3s, transform 0.3s;
            border: 1px solid #66b2ff;
            border-radius:16px;
        }
        
        .transparent-bg:hover {
            transform: scale(1.05); /* Scale up the card on hover */
        }                       
        </style>
        <div class="container mt-5">
            <h2 class="text-center">'.$name[0].' Dashboard</h2>
            <div class="row align-items-center mt-4">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card" style="box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);border: 1px solid #66b2ff;border-radius:16px;">
                        <div class="card-body transparent-bg">
                            <h5 class="card-title">Profile</h5>
                            <p class="card-text">View and update your profile details.</p>
                            <a href="?profile=1" class="btn btn-primary btn-action">Go to Profile</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card" style="box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);border: 1px solid #66b2ff;border-radius:16px;">
                        <div class="card-body transparent-bg">
                            <h5 class="card-title">'.$name[1].' Blood</h5>
                            <p class="card-text">'.$name[2].'</p>
                            <a href="?'.$name[3].'_blood=1" class="btn btn-primary btn-action">'.$name[1].' Blood</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card" style="box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);border: 1px solid #66b2ff;border-radius:16px;">
                        <div class="card-body transparent-bg">
                            <h5 class="card-title">'.$name[4].' History</h5>
                            <p class="card-text">'.$name[5].'</p>
                            <a href="?'.$name[6].'_history=1" class="btn btn-primary btn-action">'.$name[4].' History</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        ';
    }