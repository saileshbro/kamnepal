<?php
  require('../database/db.php');
  $db = new Database();
  $con = $db->con;
  $user_id = cleanse($_GET['user_id'])??'';

  $sql = "select profile.*,user.v_status from profile,user where profile.user_id='$user_id' AND user.id=profile.user_id";
  $res = mysqli_query($con,$sql);
  while($row=mysqli_fetch_array($res)){
    $fname = $row['fname'];
    $gender = $row['gender'];
    $dob=$row['dob'];
    $address=$row['address'];
    $phone=$row['phone'];
    $profile_img=$row['profile_img'];
    $study=$row['study'];
    $employ_status=$row['employ_status'];
    $experience=$row['experience'];
    $skills=$row['skills'];
    $employ_details=$row['employ_details'];
    $interest=$row['interest'];
    $category=$row['category'];
    $bio=$row['bio'];
    $updated_at = $row['updated_at'];
    $v_status = $row['v_status'];
  }
?>
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
              <h1 class='heading-primary'><?php echo $fname; ?></h1>
            </div>
            <div id="bio">
              <h3><?php echo $bio; ?></h3>
            </div>
           <div class="brief">
              <span id="gender">
                <h2><?php echo $gender; ?> </h2>
              </span>
              <span id="address">
                <h3><?php echo $address; ?></h3>
           </div>
            </span>
            <div id="employ_details">
              <h2><?php echo $employ_details; ?></h2>
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
              <h2>Verification status</h2><span class="answer" id="verify_status"><?php echo ($v_status == "no") ? "Not Verified" : "Verified";?></span>
            </li>
            <hr>
            <li class="elements">
              <h2>Employment status</h2><span class="answer" id="employ_status"><?php echo $employ_status; ?></span>
            </li>
            <hr>
            <li class="elements">
              <h2>Study</h2><span class="answer" id="study"><?php echo $study; ?></span>
            </li>
            <hr>
            <li class="elements">
              <h2>Experiences</h2><span class="answer" id="experiences"><?php echo $experience; ?></span>
            </li>
            <hr>
            <li class="elements">
              <h2>Interest</h2><span class="answer" id="interest"><?php echo $interest; ?></span>
            </li>
            <hr>
            <li class="elements">
              <h2>skills</h2><span class="answer" id="skills"><?php echo $skills; ?></span>
            </li>
            <hr>
            <li class="elements">
              <h2>Date of birth</h2><span class="answer" id="dob"><?php echo $dob; ?></span>
            </li>
            <hr>
            <li class="elements">
              <h2>Contact Number</h2><span class="answer" id="contact"><?php echo $phone; ?></span>
            </li>
            <hr>
            <li class="elements">
              <h2>Last updated at</h2><span class="answer" id="updated"><?php echo $updated_at; ?></span>
            </li>
            <hr>
          </ul>
        </div>
      </section>
      <section>
      <div class="profilebody__rightpart">
      <?php
      $sql = "select * from posts where user_id='$user_id'";
      $res=mysqli_query($con,$sql);
      while($row=mysqli_fetch_array($res)){
        echo '<div class="posts">
                <div class="post-title">
                <h2 class="heading-secondary">'.$row['title'].'
                </h2>
                </div>
                <div class="post-body">
                  <p>'.$row['body'].'</p>
                </div>
            </div>
          </div>
        ';
      }
      ?>
      </div>
      </section>
    </div>
  </div>
</body>

</html>