<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <script
			  src="http://code.jquery.com/jquery-3.3.1.min.js"
			  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			  crossorigin="anonymous"></script>
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
            <a href="#"><img src="img/logo/search-solid.svg" width='30px' alt=""></a>
        </div>
        <div class='scroll' href="#landing-main">
            <div class="scroll-arr">
            </div>
        </div>
    </div>
    <div class="container">
       <div class="landing-main" id='landing-main'>
           <div class="landing-left">
        <h2 class="landing-heading"> Top Vacancies</h2>
        <div class='landing-scroll'>
        <?php
            for($i=1;$i<=10;$i++){
                echo '<div class="job">
                <div class="job-title"><a href="" class="links"><h2>Post #'.$i.'</h2></a></div>
                <div class="job-body">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem iure assumenda officiis sapiente voluptatibus aperiam alias dignissimos cupiditate, facilis dolore adipisci odio, dolorum quasi veniam molestiae repellat voluptatem libero doloribus?</div>
                <div class="job-by">
                    <span class="job-name"><a href="">ABC Company</a></span>
                    <span class="job-date">2012/06/01</span>
                </div>
        </div>';
            }
        ?> 
        </div>
       </div>
       <div class="landing-right">
            <h2 class="landing-heading">Top companies</h2>
            <div class='company-list'>
                <?php for($i=1;$i<=5;$i++){
                    // echo('<li class="company-name"><span class="badge">'.$i.'</span><a href="">Company '.$i.'</a></li>');
                    if ($i<10) {
                        echo('<div class="company-name"><span class="badge">0'.$i.'</span><a href="">Company ABC</a>
                        <p class="company-bio">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem iure assumenda officiis sapiente voluptatibus aperiam alias dignissimos cupiditate, facilis dolore adipisci odio, dolorum quasi veniam molestiae repellat voluptatem libero doloribus?</p>
                        </div>');
                    }
                    else{
                        echo('<div class="company-name"><span class="badge">'.$i.'</span><a href="">Company ABC</a>
                        <p class="company-bio">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem iure assumenda officiis sapiente voluptatibus aperiam alias dignissimos cupiditate, facilis dolore adipisci odio, dolorum quasi veniam molestiae repellat voluptatem libero doloribus?</p>
                        </div>');
                    }
                }?>
            </div>
        </div>
    </div>
</div>
<?php
    require('footer.php');
?>
    <script src="js/app.js"></script>
</body>
</html>