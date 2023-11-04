<?php

    declare(strict_types= 1);
    require_once("../includes/session.inc.php");
    require_once("../includes/dbh.inc.php");
    
    if($_SERVER["REQUEST_METHOD"]==="POST")
    {
        try 
        {
            //code...
            $disease = $_POST["disease"];
            $unit = $_POST["unit"];
            
            $errors = [];

            if(empty($disease) || $unit==null)
            {
                $errors["donate_empty"] = "Fill all fields!";
            }
            if($unit && $unit<0) 
            {
                $errors["donate_negative"] = "Blood units cannot be negative!";
            }

            if($errors)
            {
                $_SESSION["donor_error_donate"] = $errors;
                header("Location:dashboard.php?donate_blood=1");
                die();
            }

            $query = "SELECT blood from donor where username=:current_username;";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":current_username", $_SESSION['donor']);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $blood = $result["blood"];

            $query = "SELECT id from donor where username=:current_username;";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":current_username", $_SESSION['donor']);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $donor_id = $result["id"];

            $query = "INSERT into donate(username,donor_id,disease,blood,unit) values(:current_username,:id,:disease,:blood,:unit);";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":current_username", $_SESSION["donor"]);
            $stmt->bindParam(":disease", $disease);
            $stmt->bindParam(":blood", $blood);
            $stmt->bindParam(":id", $donor_id);
            $stmt->bindParam(":unit", $unit);
            $stmt->execute();

            header("Location:dashboard.php?donations_history=1");

            $pdo = null;
            $stmt = null;

            die();


        } 
        catch (PDOException $e) 
        {
            //throw $th;
            echo $e;
        }
    }
    else 
    {
        header("Location:dashboard.php");
        die();
    }

?>