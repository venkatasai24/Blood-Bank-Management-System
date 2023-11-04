<?php

    declare(strict_types= 1);
    require_once("../includes/session.inc.php");
    require_once("../includes/dbh.inc.php");

    if($_SERVER['REQUEST_METHOD']=="POST")
    {
        $blood =  $_POST["blood"];
        $unit = $_POST["unit"];

        try 
        {

            $errors=[];

            if(empty($blood) || $unit==null)
            {
                $errors["update_empty"] = "Fill all fields!";
            }
            if($unit && $unit<0) 
            {
                $errors["update_negative"] = "Blood units cannot be negative!";
            }

            if($errors)
            {
                $_SESSION["admin_error_update"] = $errors;
                header("Location:dashboard.php");
                die();
            }

            if($blood=="A+") $blood="AP";
            if($blood=="A-") $blood="AN";
            if($blood=="B+") $blood="BP";
            if($blood=="B-") $blood="BN";
            if($blood=="AB+") $blood="ABP";
            if($blood=="AB-") $blood="ABN";
            if($blood=="O+") $blood="OP";
            if($blood=="O-") $blood="`ON`";

            $id = 1;
            $query = "UPDATE blood SET {$blood} = :unit WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":unit", $unit, PDO::PARAM_INT);
            $stmt->execute();
            
            header("Location:dashboard.php?blood=1");

            $pdo = null;
            $stmt = null;

            unset($_SESSION['admin_error_update']);

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

    ?>