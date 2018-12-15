<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../css/main.css">
  <link href="../fontawesome/css/all.css" rel="stylesheet">
  <title>Kam Nepal</title>
</head>

<body>
  <!-- <nav class="navbar">
    <div class="navbar--left">
        <img class='brand-logo' src="../img/logo/kamnepal.svg" alt="" width='96px' href='./index.php'>
    </div>
    <div class="navbar--right">
      <div class="navbar-links">
        <ul>
          <li><a href=""><img style="width: 30px; height:30px;" src="../img/logo/search-solid.svg" alt=""></a></li>
          <li><a href=""><img style="width: 30px; height:30px;" src="../img/logo/bell-regular.svg" alt=""></a></li>
          <li><a href=""><img style="width: 30px; height:30px;" src="../img/logo/cog-solid.svg" alt=""></i></a></li>
          <li><a href=""><img src="https://upload.wikimedia.org/wikipedia/commons/e/e0/Large_Scaled_Forest_Lizard.jpg" alt="a" style="width: 30px; height:30px;"></a></li>
        </ul>
      </div>
    </div>
  </nav> -->
  <div class="profilebody">
    <header>
      <div class='profilebody__header'>
        <a href="">
          <div class="profilebody__header--image">
            <img src="../img/profile/profile.jpg" alt="Avatar">
          </div>
        </a>
        <div class="text1">
          <div class="layer2">
            <div id="name">
              <h1 class='heading-primary'>Sarayu Gautam</h1>
            </div>
            <div id="bio">
              <h3>Lover of reading novels. Wants to roam the world and have fun.</h3>
            </div>
           <div class="brief">
            <span id="age">
                <h2>19</h2>
              </span>
              <span id="gender">
                <h2>Female </h2>
              </span>
              <span id="address">
                <h3>Naikap, Chandragiri, kathmandu </h3>
           </div>
            </span>
            <div id="employ_details">
              <h2>Works at kathmandu University</h2>
            </div>
          </div>
        </div>
        <div class="text2">
          <div class="links1">
            <a href="#" class="imp-link links">
              Posts
            </a>
            <a href="#" class="imp-link links">
              Study
            </a>
            <a href="#" class="imp-link links" >
              Interest
            </a>
            <a href="#" class="imp-link links" >
              Experiences
            </a>
            <a href="#" class="imp-link links" >
              Dob
            </a>
            <a href="#" class="imp-link links" >
              Contact
            </a>
            <a href="#" class="imp-link links" >
              Updated at
            </a>
            <a href="#" class="imp-link links" >
              verification status
            </a>
            <button type="submit" class='button-primary'>Edit Info</button>
          </div>
        </div>
    </header>
    <div class="middle-section clearfix">
      <section>
        <div class="profilebody__leftpart part">
          <ul>
            <li class="elements">
              <h2>Verification status</h2><span class="answer" id="verify_status">Verified</span>
            </li>
            <hr>
            <li class="elements">
              <h2>Employment status</h2><span class="answer" id="employ_status">Employed</span>
            </li>
            <hr>
            <li class="elements">
              <h2>Study</h2><span class="answer" id="study">Bachelor 2nd year in Computer
                Engineering</span>
            </li>
            <hr>
            <li class="elements">
              <h2>Experiences</h2><span class="answer" id="experiences">5 years of teaching at
                pulchok campus.</span>
            </li>
            <hr>
            <li class="elements">
              <h2>Interest</h2><span class="answer" id="interest">Dancing, Reading, Reflecting</span>
            </li>
            <hr>
            <li class="elements">
              <h2>skills</h2><span class="answer" id="skills">Typing, Teaching, Web designing</span>
            </li>
            <hr>
            <li class="elements">
              <h2>Date of birth</h2><span class="answer" id="dob">1999/01/29</span>
            </li>
            <hr>
            <li class="elements">
              <h2>Contact Number</h2><span class="answer" id="contact">9860934053</span>
            </li>
            <hr>
            <li class="elements">
              <h2>Last updated at</h2><span class="answer" id="updated">2018/11/30</span>
            </li>
            <hr>


          </ul>
        </div>
      </section>
      <section>
        <div class="profilebody__rightpart">
          <?php
          for ($i=1; $i < 20; $i++) { 
            echo ' <div class="posts"><div class="post-title">
            <h2 class="heading-secondary">
              Post #'.$i.'
            </h2>
            <div class="post-body">
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit eum  Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem illum ipsam exercitationem, dolore quisquam, doloremque consequatur at officia beatae itaque qui tempora a hic ut rerum. Consequuntur laborum id voluptas. voluptate expedita eaque molestias amet aliquid aspernatur deleniti tenetur porro.</p>
            </div></div></div>';
          }
          ?>
          </div>
        </div>
      </section>
    </div>
  </div>
</body>

</html>