<?php
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
    <link rel="stylesheet" href="../css/main.css">
    
    <title>Kam Nepal | Register</title>
</head>
<body style='overflow:hidden;'>
<nav class="navbar">
        <div class="navbar--left">
            <i class="fa fa-graduation-cap brand-logo"></i>
            <a href='../index.php' class='brand-header links'>Kam Nepal</a>
        </div>
        <div class="navbar--right">
            <a class='links' href="./jobseeker.php">Signup as Jobseeker</a>
        </div>
</nav>
 <div class="register register-bg-2">
        <div class="register-body">
            <form class='form' id='regForm' action="" onsubmit="completeRegistration();return false;">
                <h1 class="heading-secondary">Create your free Employer Account</h1>
                <div class="error">
                    <h2 id="error"></h2>
                </div>
                <input type='text' name='fname' placeholder='Organisation Name' required autocapitalize="words">
                <select name="category" id="">
                    <option value="Jobs" selected="true" disabled="disabled">Jobs</option>
                    <?php
                        $sql ="select * from category";
                        $res = mysqli_query($con,$sql);
                        while($row=mysqli_fetch_array($res)){
                            echo "<option value=".$row['id'].">".$row['name']."</option>";
                        }
                    ?>
                </select>
                <input type="text" name='phone' placeholder='Organisational Phone Number' required>
                <input type="hidden" name='type' value='Employer' required>
                <input type="email" name="email" id="" placeholder='Office Email' required>
                <input type="password" name="password" id="" placeholder='Password' required>
                <input type="password" name='password2' placeholder='Confirm Password' required>
                <button type="submit" class='button-primary'>Create a Employer Account</button>
                <p class='form-text'>Already have a Employer account? <a class='links'href="">Login</a></p>
            </form>
        </div>
    </div>
<script>
    var elem=document.getElementById('overlay');
    function shift(item){
        let slide=item.parentNode.getElementsByClassName('slider');
        for(let i=0;i<slide.length;i++){
            slide[i].classList.toggle('on');
        }
        item.classList.add('on');
        elem.classList.toggle('on');
    }
</script>
<script
			  src="http://code.jquery.com/jquery-3.3.1.min.js"
			  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			  crossorigin="anonymous"></script>

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