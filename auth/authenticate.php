<?php
    session_start();
    $email = $_SESSION['email']?? "";
    if(strlen($email)===0){
        header('Location: /login/login.php');
        die();
    }
?>