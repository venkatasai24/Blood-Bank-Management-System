<?php

    declare(strict_types= 1);
    require_once("../includes/dbh.inc.php");
    require_once("../includes/session.inc.php");

    if($_SERVER['REQUEST_METHOD']=="POST")
    {
        $id = $_POST['id'];

        try 
        {
            //code...
            if(isset($_POST['patient']))
            {
                $query = "DELETE from patient where id=:id;";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(":id",$id);
                $stmt->execute();
                
                header('Location:dashboard.php?patients=1');
            }
            else if(isset($_POST['donor']))
            {
                $query = "DELETE from donor where id=:id;";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(":id",$id);
                $stmt->execute();
                
                header('Location:dashboard.php?donors=1');
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

?>