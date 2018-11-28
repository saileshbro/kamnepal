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
                <a class='links' href="./employer.php">Signup as Employer</a>
            </div>
    </nav>
        <section>
        <div class="register register-bg-2">
            <div class="register-body">
                <form class='form' action="">
                    <h1 class="heading-secondary">Create your free Jobseeker Account</h1>
                    <input type='text' name='full-name' placeholder='Full Name' required autocapitalize="words">
                    <select name="categories" id="">
                        <option value="1">Jobs</option>
                    </select>
                    <input type="text" name='mobile' placeholder='Mobile Number' required>
                    <input type="email" name="email" id="" placeholder='Email' required>
                    <input type="password" name="password" id="" placeholder='Password' required>
                    <input type="password" name='password-confirm' placeholder='Confirm Password' required>
                    <button type="submit" class='button-primary'>Create a Jobseeker Account</button>
                    <p class='form-text'>Already have a Jobseeker account? <a class='links'href="">Login</a></p>
                </form>
            </div>
        </div>
        </section>
    </body>
</html>
    
    <!-- <div class="slider">
        <div class="sliderMode">
            <div class="slider left on" onclick="shift(this);">
                <p>Individual</p>
            </div>
            <div class="slider right" onclick="shift(this);">
                <p>Business</p>
            </div>
            <aside class="overlay" id="overlay" >
            </aside>
        </div>
    </div> -->
    <!-- <script>
    var elem=document.getElementById('overlay');
    function shift(item){
        let slide=item.parentNode.getElementsByClassName('slider');
        for(let i=0;i<slide.length;i++){
            slide[i].classList.toggle('on');
        }
        item.classList.add('on');
        elem.classList.toggle('on');
    }
</script> -->