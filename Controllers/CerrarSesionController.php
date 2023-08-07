<?php

    if(session_status() == PHP_SESSION_NONE)
    {
        session_start();
    }
    if(isset($_POST["btnSalir"])){
        session_destroy();
        header("location: ../Views/login.php");
    }
    
?>