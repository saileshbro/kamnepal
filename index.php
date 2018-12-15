<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
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
            <!-- <div class="navbar-center">
                <img class='brand-logo' src="img/logo/kamnepal.svg" alt="" width='90rem' height='90rem' href='./index.php'>
            </div> -->
            <div class="navbar-right">
                <div class="navbar-links">
                    <ul>
                        <li><a href="#" class="links">Create a CV</a></li>
                        <li><a href="/login/login.php"  class="links" >Login</a>
                        </li>
                        <li><a href="#" id='register' onclick='toggleDropdown()' class="links">Register</a>
                        <div class="dropdown">
                                <div class="dropdown-content">
                                    <div class=dropdown-nav>
                                        <p id='drop-nav' onclick='toggleRegistration()' class='active'>Jobseeker</p>
                                        <p id='drop-nav' onclick='toggleRegistration()'>Employer</p>
                                    </div>
                                    <div class="dropdown-body">
                                        <div class='jobseeker drop-active show '>
                                            <img src="../img/logo/user-regular.svg" alt="" width='60px'>
                                            <div class="btn-dp button-primary">
                                            <a  href='/register/jobseeker.php'>Register</a>
                                            </div>
                                            <hr>
                                            <h3 class="heading-secondary">Jobseeker</h3>
                                            <p>Create a free account to apply for jobs</p>
                                        </div>
                                        <div class='employer drop-active '>
                                            <img src="../img/logo/building-regular.svg" alt="" width='60px'>
                                            <div class="btn-dp button-secondary">
                                            <a  href='/register/employer.php'>Register</a>
                                            </div>
                                            <hr>
                                            <h3 class="heading-secondary">Employer</h3>
                                            <p>Create a free acount to post vacancy.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <div class="landing-search">
            <input type="text" placeholder='Search here...'>
            <a href="#"><img src="/img/logo/search-solid.svg" width='30px' alt=""></a>
        </div>
       
    </div>
    <br>
    <div class="container" style='height:400px;'>
        <div class="landing-jobs">
            <h1 class='heading-primary'>Vacancies</h1>
            <br>
            <?php
                for($i=0;$i<10;$i++){
                    echo '<div class="card">
                    <div class="card-title">
                        <h4>Job name</h4>
                    </div>
                    <div class="card-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus, praesentium.</p>
                    </div>
                    <div class="card-footer">
                        <a>Company name</a>
                    </div>
                </div>';
                }
            ?>
            <div class="card">
                    <div class="card-title">
                        <h4>Job name</h4>
                    </div>
                    <div class="card-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus, praesentium.</p>
                    </div>
                    <div class="card-footer">
                        <a>Company name</a>
                    </div>
                </div>
        </div>
    </div>
    <script>
        function toggleDropdown(){
            let element = document.querySelector('#register');
            document.querySelector('.dropdown').classList.toggle("show");
        }
        function toggleRegistration(){
            let element = document.querySelectorAll('#drop-nav');
            let element2 = document.querySelectorAll('.drop-active');
            for(let i =0;i<element.length;i++){
                element[i].classList.toggle('active');
            }
            for(let i =0;i<element2.length;i++){
                element2[i].classList.toggle('show');
            }
            
        }
    </script>
</body>
</html>