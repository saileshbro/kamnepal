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
    $employ_status=$row['employ_status'];
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
            <a href="update.php?user_id=<?php echo $user_id?>" type="submit" class='button-primary'>Edit Info</a>
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
              <h2>Interest</h2><span class="answer" id="interest"><?php echo $interest; ?></span>
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