<?php 
        session_start(); // Start the session
        if(!isset($_SESSION['username'])){
            header("Location: login.php"); // Redirect to login page if not logged in
            exit();
        }else{
            echo "<script>console.log('Logged in')</script>";
        } 
            session_unset(); // Unset all session variables
            session_destroy(); // Destroy the session
            header("Location: login.php"); // Redirect to the login page
            exit();               
    ?>