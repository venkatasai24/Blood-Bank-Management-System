<?php
    function login_template(string $path,string $name,string $extra)
    {
        echo 
        '
        <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="form-container">
                <div class="d-flex justify-content-between">
                    <h2 class="text-center">'.$name.'</h2>
                    <a href="../index.php" class="btn"><i style="font-size:25px;" class="fa fa-home"></i></a>
                </div>
                <form action='.$path.' method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Enter your username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="pwd" placeholder="Enter your password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
                '.$extra.'
                </div>
            </div>
        </div>
        ';
    }

    function register_template(string $name)
    {
        echo
        '
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="form-container">
                    <div class="d-flex justify-content-between">
                        <h2 class="text-center">'.$name.'</h2>
                        <a href="../index.php" class="btn"><i style="font-size:25px;" class="fa fa-home"></i></a>
                    </div>
                    <form action="register.inc.php" method="post">
                    <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter your name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter your email">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" placeholder="Enter your username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="pwd" placeholder="Enter your password">
                        </div>
                        <div class="form-group">
                            <label for="bloodgroup">Blood Group</label>
                            <select class="form-control" name="blood">
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
                        <!-- Add more registration fields as needed -->
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </form>
                    <p class="text-center mt-3">Already have an account? <a href="login.php">Login here</a></p>
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
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4"> 
            <div class="card border-danger" style="box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);">
                <div class="card-body">
                    <p class="card-text">'.$name1.' : ' . $row[$name2] . '</p>
                    <p class="card-text">Units : ' . $row['unit'] . '</p>
                    <b><p class="card-text">' . $row['status'] . '</p></b>
                </div>
            </div>
        </div>
        ';
    }