<?php
require '../database/db.php';
$db = new Database();
$con = $db->con;
$user_id = cleanse($_GET['user_id']) ?? '';
$sql = "select profile.*,user.v_status from profile,user where profile.user_id='$user_id' AND user.id=profile.user_id";
$res = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($res)) {
  $fname = $row['fname'];
  $gender = $row['gender'];
  $dob = $row['dob'];
  $address = $row['address'];
  $phone = $row['phone'];
  $profile_img = $row['profile_img'];
  $employ_status = $row['employ_status'];
  $interest = $row['interest'];
  $category = $row['category'];
  $bio = $row['bio'];
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
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/main.css">
  <title>Kam Nepal</title>
</head>

<body onload="document.getElementById('about').click();$('#about').trigger('click');">
<?php require '../includes/modal-education.php'; ?>
<?php require '../includes/modal-experience.php'; ?>
<?php include '../index-nav.php'; ?>
<div class="Profile-main-body">
  <div class="profile-left">
    <div class="prof-head-img">
       <img src="../img/profile/profile.jpg" alt="profile-pic">
    </div>
    <div class="prof-body-part-left">
      <div class="left-elements">
        <div class="left-heading">
          <div class='title'>
            <h3 class="one">Education</h3>
            <a href="javascript:;" class="two" id="education-more">+</a>
          </div>
          <div class='body'>
            <?php $sql = "select * from education where user_id =' $user_id ' limit 1";
            $res = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($res);
            ?>
            <h4 class="first-line"><?php echo $row['course_title'] ?></h4>
            <p class="second-line"><?php echo $row['inst_name'] ?></p>
          </div>
        </div>
      </div>
      <div class="left-elements">
        <div class="left-heading">
          <div class='title'>
            <h3 class="one">Experience</h3>
            <a href="javascript:" class="two" id="experience-more">+</a>
          </div>
          <div class="body">
          <?php $sql = "select * from experience where user_id =' $user_id ' limit 1";
          $res = mysqli_query($con, $sql);
          $row = mysqli_fetch_array($res);
          ?>
            <h4 class="first-line"><?php echo $row['emp_title'] ?></h4>
            <p class="second-line"><?php echo $row['emp_comp'] ?></p>
          </div>
        </div>
      </div>
      <!-- <hr> -->
      <div class="left-bottom">
        <h1 class="left-bottom-heading">Skills</h1>
        <div class='skill-set'>
          <div>
            <h3 class="bottom-main">Language:</h3>
            <h3 class="bottom-main">Programming:</h3>
            <h3 class="bottom-main">Extra:</h3>
          </div>
          <div>
              <h4 class="bottom-text">English, Japanese, Hindi, French</span>
              <h4 class="bottom-text">C, C++, Python, PHP</h4>
              <h4 class="bottom-text">Typing, Journaling, Auditing</h4>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="profile-right">
    <div class="prof-head-info">
      <h2 class="prof-head-name "><?php echo $fname; ?></h2>
      <p class="prof-head-address"><i class="fas fa-map-marker-alt"></i><?php echo $address; ?></p>
      <p class="prof-head-bio"><?php echo $bio; ?></p>
      <span class="prof-head-gender"><?php echo $gender; ?> </span>
      <span class="prof-head-interest"><?php echo $interest; ?></span>
      <a href="" class="message"><i class="far fa-envelope"></i>Message</a>
      <a href="update.php" class="message"><i class="far fa-edit"></i></i>Edit Profile</a>
      <a href="" class="message"><i class="fas fa-print"></i></i>Print CV</a>
    </div>
    <div class="prof-head-switch">
        <a class="prof-timeline" id="timeline" href="javascript:;"><i class="far fa-eye"></i>Timeline </a>
        <a class="prof-about when" class="when"id="about" href="javascript:;"><i class="far fa-user"></i>About</a>
    </div>


    <div class="prof-body-part-right">
      <div id="timeline-right">
        <div class="job">
          <div class="job-title" id="job-title"><a href="javascript:;" class="links"><h2>Title</h2></a></div>
          <div class="job-body">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam quo tempore voluptas nisi! Similique soluta eum repellendus earum, fuga repudiandae doloribus adipisci? Odio ipsum voluptate alias, hic nam tempore omnis.</div>
          <div class="job-by">
          <span class="job-name"><a href="">ABC Company</a></span>
          <span class="job-date">2012/06/01</span>
          </div>
        </div>
      </div>
      <div id="about-right">
        <div id='ext'>
        <h1>Contact</h1>
        <div class="right-elements">
        <span class="heading"><i class="fas fa-phone"></i>Phone</span>
        <span class="text"><?php echo $phone; ?><span>
        </div>
        <div class="right-elements">
        <span class="heading"><i class="fas fa-at"></i>Email</span>
        <span class="text">sailbro@gmail.com<span>
        </div>
        </div>
      <div id='ext'>
      <h1>Extra Information:</h1>
        <div class="right-elements">
        <span class="heading"><i class="fas fa-calendar-alt"></i>Date Of Birth</span>
        <span class="text"><?php echo $dob; ?></span>
        </div>
        <div class="right-elements">
        <span class="heading"> <?php echo ($v_status == 'no') ? "<i class='fas fa-times'></i>" : "<i class='fas fa-check'></i>"; ?> Verification Status</span>
        <span class="text"><?php echo ($v_status == 'no') ? 'Not Verified' : 'Verified'; ?></span>
        </div>
        
        <div class="right-elements">
        <span class="heading"><i class="fas fa-briefcase"></i>Employment Status</span>
        <span class="text"><?php echo $employ_status; ?></span>
        </div>
        <div class="right-elements">
        <span class="heading"><i class="fas fa-sync"></i>Last Updated at</span>
        <span class="text"><?php echo $updated_at; ?></span>
        </div>
      </div>
      </div>
    </div>
  </div>
  </div>
</div>
<?php include '../includes/footer.php' ?>
<script src="../js/app.js"></script>
</body>

</html>
