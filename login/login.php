<?php
require('../database/db.php');
$db = new Database;
$con = $db->con;
session_start();
$email = $_SESSION['email'] ?? "";
$user_id = getColumn("SELECT id FROM user WHERE email='$email'", "id");
if (strlen($email) > 0) {
        // redirect after login
    header("Location: ../dashboard.php?user_id=$user_id");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="../css/main.css">
    
    <title>Kam Nepal | Login</title>
</head>
<body style="overflow:hidden;">
<div class="modal-forgot login">
    <div class='login-body'>
        <a href="javascript:;" class="modal-title" onclick="$('.modal-forgot').fadeOut();">&times;</a>
        <div id="resetFrom" >
            <input type="email" name='email' placeholder="Email">
            <a href="javascript:;" id="getReset" class="links">Get Password reset Link</a>
        </div>
    </div>
</div>
    <nav class="navbar">
            <div class="navbar--left">
                <a href='../index.php' class='brand-header links'>Kam Nepal</a>
            </div>
            <div class="navbar--right">
                <a class='links' href="/register/jobseeker.php">Sign up</a>
            </div>
    </nav>
        <section>
        <div class="login">
            <div class="login-body">
                <form class='form'id='loginForm' action="" onsubmit='login();return false;'>
                    <h1 class="heading-secondary">Sign in to your account</h1>
                    <div class="error">
                        <h2 id="error"></h2>
                    </div>
                    <input type="email" name="email" id="" placeholder='Email' required>
                    <input type="password" name="password" id="" placeholder='Password' required>
                    <a class='links'href="javascript:;" id="forgotPassword">Forgot Password?</a></p>
                    <button type="submit" class='button-primary'>Login</button>
                    <hr>
                    <p class="form-text">Or Sign in with</p>
                    <div class="social-login">
                        <button class="button-secondary">Google</button>
                        <!-- <button class="button-primary">Facebook</button>
                        <button class="button-tertiary">Twitter</button> -->
                    </div>
                </form>
            </div>
        </div>
        </section>
        <?php include "../includes/footer.php" ?>
        <script>
function login(){
    $('#error').html('<img src="/img/gif/loading.gif" alt="" srcset="" style="width:72px;">');

    $.ajax({
        url: 'posts/login.php',
        method: 'post',
        data: $('#loginForm').serializeArray(),
        success: function(data){
            $('#error').html(data);
        },
        error: function(){
            $('#error').html('Unable to connect to server.');
        }
    });
}
$('#getReset').click(() => {
    var myData = $('#resetForm :input').serialize();
    $.ajax({
        url : "posts/reset.php",
        data: myData,
        type: "POST",
        success: (data)=>{
            alert(data);
        }
    });
  });
        </script>

        <script src="/js/app.js"></script>
    </body>
    
</html>