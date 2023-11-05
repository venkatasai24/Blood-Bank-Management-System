<?php

        $host="localhost";
        $dbname= "BBMS";
        $dbusername= "root";
        $dbpassword= '';

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch (PDOException $e) {
            //throw $th;
            die('connection failed: '. $e->getMessage());
        }

?>