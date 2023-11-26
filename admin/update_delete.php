<?php

    declare(strict_types= 1);
    require_once("../includes/dbh.inc.php");
    require_once("../includes/session.inc.php");

    if($_SERVER['REQUEST_METHOD']=="POST")
    {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $username = $_POST['username'];

        try 
        {
            //code...
            $query = "SELECT id from admin where username=:current_username;";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":current_username", $_SESSION['admin']);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $admin_id = $result["id"];

            $errors = [];

            if(empty($username) || empty($email) || empty($name))
            {
                $errors["admin_error_profile"] = "Fill all fields!";
            }
            if(username_exists($pdo,$username,$admin_id))
            {
                $errors["user_exists"] = "user already exists!";
            }
            if(email_exists($pdo,$email,$admin_id))
            {
                $errors["email_exists"] = "email already exists!";
            }

            if($errors)
            {
                $_SESSION["admin_error_profile"] = $errors;
                header("Location:dashboard.php?profile=1");
                die();
            }

            if(isset($_POST['update']))
            {
                $query = "UPDATE admin set username=:username,email=:email,name=:name where id=:id;";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(":name", $name);
                $stmt->bindParam(":email", $email);
                $stmt->bindParam(":username", $username);
                $stmt->bindParam(":id", $admin_id);
                $stmt->execute();
    
                $_SESSION['admin']=$username;
    
                
                header('Location:dashboard.php?profile=1');
            }
            else if(isset($_POST['delete']))
            {
                $query = "DELETE from admin where id=:id;";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(":id",$admin_id);
                $stmt->execute();
                
                header('Location:dashboard.php?logout=1');
            }

            $pdo = null;
            $stmt = null;

            die();

        } 
        catch (PDOException $e) 
        {
            //throw $th;
            echo $e->getMessage();
        }

    }
    else
    {
        header("Location:dashboard.php");
        die();
    }
    function username_exists(object $pdo,string $username,int $id)
    {
        $query = "SELECT username from admin where username=:username and id!=:id;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result) return true;
        return false;
    }

    function email_exists(object $pdo,string $email,int $id)
    {
        $query = "SELECT email from admin where email=:email and id!=:id;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result) return true;
        return false;
    }

?>