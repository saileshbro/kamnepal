<?php
// register as jobseeker
include "../database/db.php";
$db = new Database();
$con = $db->con;
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
    
    <title>Kam Nepal | Register</title>
</head>
<body style="overflow:hidden;">
    <nav class="navbar">
            <div class="navbar--left">
                <a href='../index.php' class='brand-header links'>Kam Nepal</a>
            </div>
            <div class="navbar--right">
                <a class='links' href="./employer.php">Signup as Employer</a>
            </div>
    </nav>
        <section>
        <div class="register register-bg-2">
            <div class="register-body">
                <form class='form' id='regForm' action="" onsubmit="completeRegistration();return false;">
                    <h1 class="heading-secondary">Create your free Jobseeker Account</h1>
                    <div class="error">
                        <h2 id="error"></h2>
                    </div>
                    <input type='text' name='fname' placeholder='Full Name' required autocapitalize="words">
                    <select name="category" >
                        <option value="Jobs" selected="true" disabled="disabled">Jobs</option>
                        <?php
                        $sql = "select * from category";
                        $res = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_array($res)) {
                            echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
                        }
                        ?>
                    </select>
                    <input type="text" name='phone' placeholder='Mobile Number' required>
                    <input type="hidden" name='type' value='Jobseeker' required>
                    <input type="email" name="email"placeholder='Email' required>
                    <input type="password" name="password"placeholder='Password' required>
                    <input type="password" name='password2' placeholder='Confirm Password' required>
                    <button type="submit" class='button-primary'>Create a Jobseeker Account</button>
                    <p class='form-text'>Already have a Jobseeker account? <a class='links'href="../login/login.php">Login</a></p>
                </form>
            </div>
        </div>
        </section>
        <?php include "../includes/footer.php"; ?>
        <script>
        function completeRegistration(){
            $('#error').html('<img src="/img/gif/loading.gif" alt="" srcset="" style="width:72px;">');

            $.ajax({
                url: 'posts/register.php',
                method: 'post',
                data: $('#regForm').serializeArray(),
                success: function(data){
                    $('#error').html(data);
                },
                error: function(){
                    $('#error').html('Unable to connect to server.');
                }
            });
        }
        </script>
    </body>
</html>