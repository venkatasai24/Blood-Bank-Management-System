<?php 

    declare(strict_types= 1);
    require_once("../includes/session.inc.php");
    
    if($_SERVER["REQUEST_METHOD"]==="POST")
    {
        $pwd = $_POST["pwd"];
        $username = $_POST["username"];

        try 
        {
            //errors
            $errors = [];
    
            if(checkInput($pwd,$username))
            {
                $errors["check_input"] = "Fill all fields!";
            }
            if(!username_exists($username,$pwd))
            {
                $errors["incorrect"] = "Incorrect Login Info!";
            }

             if($errors)
             {
                $_SESSION["admin_error_login"] = $errors;
                header("Location:login.php");
                die();
             }

             $_SESSION["admin"]=$username;

             header("Location:login.php?login=success");

             $pdo = null;
             $stmt = null;

             die();

             
        } 
        catch (PDOException $e) 
        {
            //throw $th;
            die("query failed: ". $e->getMessage());
        }

    }
    else 
    {
        header("Location:login.php");
        die();
    }
    function checkInput(string $pwd, string $username)
    {
        return empty($pwd) || empty($username);
    }
    function username_exists(string $username,string $pwd)
    {
        $superuserUsername = "superuser";
        $superuserPassword = "6IcRHIEh6sf0iChf8B758g==";
    
        return $username === $superuserUsername && $pwd === $superuserPassword ;
    }
    
?>