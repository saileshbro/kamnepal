<?php
require '../../database/db.php';
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
  <link rel="stylesheet" href="../../css/main.css">
  <title>Kam Nepal</title>
</head>

<body onload="document.getElementById('about').click();$('#about').trigger('click');">
<?php require '../../includes/modal-education.php'; ?>
<?php require '../../includes/modal-experience.php'; ?>
<?php include '../../index-nav.php'; ?>
<div class="Profile-main-body">
  <div class="profile-left">
    <div class="prof-head-img2">
       <img src="../../img/profile/profile.jpg" alt="profile-pic">
       <a href='update.php' class='message'><i class='far fa-edit'></i></i>Edit Profile</a>
    </div>
    <div class="org-left-body">
      <div class="org-head-info">
        <h1 class="org-name"><?php echo $fname; ?></h1>
        <span class="org-address"><i class="fas fa-map-marker-alt"></i><?php echo $address; ?></span>
        <p class="org-bio"><?php echo $bio; ?></p>
      </div>
      <div class="org-body-info">
        <div class="right-elements">
          <span class="heading"> <i class="fas fa-phone"></i>Contact Number</span>
          <span class="text"><?php echo $phone; ?></span>
        </div>
        <div class="right-elements">
          <span class="heading"><i class="fas fa-at"></i>Email</span>
          <span class="text"><?php echo $email; ?></span>
        </div>
        <div class="right-elements">
          <span class="heading"><i class="fas fa-calendar-alt"></i>Estd</span>
          <span class="text"><?php echo $dob; ?></span>
        </div>
        <div class="right-elements">
          <span class="heading"><i class="fas fa-hashtag"></i>No of Posts</span>
          <span class="text">15</span>
        </div>
      </div>
    </div>
  </div>
  <div class="profile-right">
    <div class="job">
      <div class="job-title" id="job-title"><a href="javascript:;" class="links"><h2>Title</h2></a></div>
      <div class="job-body">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam quo tempore voluptas nisi! Similique soluta eum repellendus earum, fuga repudiandae doloribus adipisci? Odio ipsum voluptate alias, hic nam tempore omnis.</div>
      <div class="job-by">
      <span class="job-name"><a href="">ABC Company</a></span>
      <span class="job-date">2012/06/01</span>
      </div>
    </div>
  </div>
  </div>
</div>
<?php include '../../includes/footer.php' ?>
<script> user_id = <?= $user_id ?></script>

<script src="../../js/app.js"></script>
</body>

</html>
