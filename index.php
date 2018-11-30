<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/main.css">
    <title>Kam Nepal</title>
</head>
<body>
    <div class="landing-body">
    <nav class="navbar-landing" id='#navbar-landing'>
        <div class="navbar-left">
            <div class="navbar-links">
                <ul>
                    <li><a class='links' href="#">Find a job</a></li>
                    <li><a class='links' href="#">Post a job</a></li>
                </ul>
            </div>    
        </div>
        <div class="navbar-center">
            <img class='brand-logo' src="img/logo/kamnepal.svg" alt="" width='150rem' height='150rem' href='./index.php'>
        </div>
        <div class="navbar-right">
            <div class="navbar-links">
                <ul>
                    <li><a href="#" class="links">Create a CV</a></li>
                    <li><a href="#"  class="links" >Login</a>
                    </li>
                    <li><a href="#" id='register' onclick='myFunction()' class="links">Register</a>
                    <div class="dropdown">
                            <div class="dropdown-content">
                                    <div>
                                        <h3 class='dropdown-title'>Employer</h3>
                                        <img src="img/logo/user-regular.svg" alt="">
                                        <a href="" class="button-primary">Register</a>
                                    </div>
                                    <div>
                                        <h3 class='dropdown-title'>Jobseeker</h3>
                                        <img src="img/logo/building-regular.svg" alt="">
                                        <a href="" class="button-primary">Register</a>
                                    </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    </div>
    <br>
    <div class="container" style='height:400px;'>
        <div class="landing-jobs">
            <h1 class='heading-secondary'>Hot jobs</h1>
        </div>
    </div>
    <script>
        function myFunction(){
            var element = document.querySelector('#register');
            console.log(document.querySelector('.dropdown').classList.toggle("show"));
        }
    </script>
</body>
</html>