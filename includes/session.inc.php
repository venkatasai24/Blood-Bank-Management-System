<?php

    ini_set("session.use_only_cookies", 1);
    ini_set("session.use_strict_mode", 1);
    
    session_set_cookie_params([
        "lifetime" => 3600, // Set your desired session lifetime
        "domain" => "localhost",
        "path" => "/",
        "secure" => true,
        "httponly" => true
    ]);
    
    session_start();
    
    if (!isset($_SESSION["last_regeneration"])) 
    {
        regenerate_session_id();
    } 
    else 
    {
        $interval = 60 * 30; // 30 minutes
    
        if (time() - $_SESSION["last_regeneration"] >= $interval) {
            // Automatically destroy the session after the specified interval
            session_unset();
            session_destroy();
            session_start(); // Optionally, you can start a new session
        }
    }
    
    function regenerate_session_id()
    {
        session_regenerate_id(true);
        $_SESSION["last_regeneration"] = time();
    }

?>