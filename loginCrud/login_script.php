<?php 
   session_start();
   include "65_41_conDB.php";
   

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];
        

        $server->login($connect, $table,$email, $password);
        
    }
      
  
  
  
  ?>