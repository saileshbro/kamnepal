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
    <div id="landing">
    <div class="landing-body" id='landing-body'>
        <?php require('includes/navbar-landing.php');?>
        <div class="navbar-center" id='navbar-center'>
            <a href="/index.php"><img class='brand-logo' src="../img/logo/kamnepal.svg" alt="" width='90rem' height='90rem' href='./index.php'></a>
        </div>
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
    require('includes/footer.php');
?>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js" integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs" crossorigin="anonymous"></script>
        <script src="js/app.js"></script>
    </body>
</html>