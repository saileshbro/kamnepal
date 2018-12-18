<?php
  require('../auth/authenticate.php');
  require('../database/db.php');
  $db = new Database;
  $con = $db->con;
  $user_id = getColumn("SELECT id FROM user WHERE email='$email'", "id");

  if (isset($_POST['update'])){
    $fname = cleanse($_POST['fname'])??'';
    $gender = cleanse($_POST['gender'])??'';
    $dob = cleanse($_POST['dob'])??'';
    $address = cleanse($_POST['address'])??'';
    $phone = cleanse($_POST['phone'])??'';
    $study = cleanse($_POST['study'])??'';
    $employ_status = cleanse($_POST['employ_status'])??'';
    $experience = cleanse($_POST['experience'])??'';
    $skills = cleanse($_POST['skills'])??'';
    $employ_details = cleanse($_POST['employ_details'])??'';
    $interest = cleanse($_POST['interest'])??'';
    // $category = cleanse($_POST['category'])??'';
    $bio = cleanse($_POST['bio'])??'';
    // $updated_at = cleanse($_POST['updated_at'])??'';
    $sql = "UPDATE profile SET fname='$fname',gender='$gender',dob='$dob',address='$address',phone='$phone',study='$study',employ_status='$employ_status',experience='$experience',skills='$skills',employ_details='$employ_details',interest='$interest',bio='$bio' WHERE user_id='$user_id'";
    mysqli_query($con,$sql);

  }


  $sql = "select * from profile where user_id='$user_id'";
  $res = mysqli_query($con,$sql);
  while($row=mysqli_fetch_array($res)){
    $fname = $row['fname'];
    $gender = $row['gender'];
    $dob=$row['dob'];
    $address=$row['address'];
    $phone=$row['phone'];
    // $profile_img=$row['profile_img'];
    $study=$row['study'];
    $employ_status=$row['employ_status'];
    $experience=$row['experience'];
    $skills=$row['skills'];
    $employ_details=$row['employ_details'];
    $interest=$row['interest'];
    // $category=$row['category'];
    $bio=$row['bio'];
    $updated_at = $row['updated_at'];
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="stylesheet" href="../css/main.css" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous" />
  <title>Kam Nepal</title>
</head>

<body>
  <!-- navbar here -->
  <!-- <nav class="navbar">
    <div class="navbar--left">
      <img class="brand-logo" src="../img/logo/kamnepal.svg" alt="" width="96px" href="./index.php" />
      -- <a href='./index.php' class='brand-header links'>Kam Nepal</a> -->
  <!-- </div>
    <div class="navbar--right">
      <div class="navbar-links">
        <ul>
          <li>
            <a href=""><img style="width: 30px; height:30px;" src="../img/logo/search-solid.svg" alt="" /></a>
          </div>
          <li>
            <a href=""><img style="width: 30px; height:30px;" src="../img/logo/bell-regular.svg" alt="" /></a>
          </div>
          <li>
            <a href=""><img style="width: 30px; height:30px;" src="../img/logo/cog-solid.svg" alt="" /></a>
          </div>
          <li>
            <a href=""><img src="https://upload.wikimedia.org/wikipedia/commons/e/e0/Large_Scaled_Forest_Lizard.jpg"
                alt="a" style="width: 30px; height:30px;" /></a>
          </div>
        </ul>
      </div>
    </div>
  </nav> -->
  <!-- end navbar -->
  <div class="containerProfile">
    <div class="profileUpdate">
      <div class="headingpart">
        <h1 class='heading-primary'>Update Profile</h1>
        <!-- <span> update your personal information</span> -->
      </div>
      <hr>
      <div class="infopart">
        <form class="form1" action="" method='post'>
              <div class="list2">
                  <img id="avatar" class="list2__image" src="../img/profile/profile.jpg" alt="Avatar" />
                  <!-- <a href="3" id='edit-a'><img src="../img/logo/pencil-alt-solid.svg" alt="" srcset="" width='20px'></a> -->
                <!-- <input type="file" name="" id="edit-a"> -->
              </div>
              <div class="list1">
                <label class="label1" for="name">Name</label>
                <input name='fname' class="input1" id="fname" type="text" value="<?php echo $fname?>">
              </div>
              <div class="list1">
                <label class="label1" for="gender">Gender</label>
                <div class="radios">
                <?php
                  if($gender==='male'||$gender==='Male'){
                    echo '   <div class="radios__item">
                    <input name="gender" class="input2" id="male" type="radio" name="gender" value="Male" checked />
                    <label class="label2" for="male">Male</label>
                  </div>
                  <div class="radios__item">
                    <input name="gender" class="input2" id="female" type="radio" name="gender" value="Female" />
                    <label class="label2" for="female">Female</label>
                  </div>
                  <div class="radios__item">
                    <input name="gender" class="input2" id="others" type="radio" name="gender" value="other" />
                    <label class="label2" for="others">Others</label>';
                  }
                  else if($gender==='female'||$gender==='Female'){
                    echo '   <div class="radios__item">
                    <input name="gender" class="input2" id="male" type="radio" name="gender" value="Male" />
                    <label class="label2" for="male">Male</label>
                  </div>
                  <div class="radios__item">
                    <input name="gender" class="input2" id="female" type="radio" name="gender" value="Female" checked />
                    <label class="label2" for="female">Female</label>
                  </div>
                  <div class="radios__item">
                    <input name="gender" class="input2" id="others" type="radio" name="gender" value="other" />
                    <label class="label2" for="others">Others</label>';
                  }
                  else if($gender==='others'||$gender==='Others'){
                    echo '   <div class="radios__item">
                    <input name="gender" class="input2" id="male" type="radio" name="gender" value="Male" />
                    <label class="label2" for="male">Male</label>
                  </div>
                  <div class="radios__item">
                    <input name="gender" class="input2" id="female" type="radio" name="gender" value="Female"  />
                    <label class="label2" for="female">Female</label>
                  </div>
                  <div class="radios__item">
                    <input name="gender" class="input2" id="others" type="radio" name="gender" value="other" checked/>
                    <label class="label2" for="others">Others</label>';
                  }
                  else{
                    echo '   <div class="radios__item">
                    <input name="gender" class="input2" id="male" type="radio" name="gender" value="Male" />
                    <label class="label2" for="male">Male</label>
                  </div>
                  <div class="radios__item">
                    <input name="gender" class="input2" id="female" type="radio" name="gender" value="Female"  />
                    <label class="label2" for="female">Female</label>
                  </div>
                  <div class="radios__item">
                    <input name="gender" class="input2" id="others" type="radio" name="gender" value="other"/>
                    <label class="label2" for="others">Others</label>';
                  }
                ?>
                  </div>
                </div>
              </div>
              <div class="list1">
                <label class="label1" for="address">Address</label>
                <textarea name='address' id="address" class="input1"><?php echo($address)?></textarea>
              </div>
              <div class="list1">
                <label class="label1" for="employdetail">Employment details</label>
                <textarea name='employ_details' id="employdetail" class="input1"><?php echo($employ_details)?></textarea>
              </div>
              <div class="list1">
                <label class="label1" for="bio">Bio</label>
                <textarea name='bio' id="bio" class="input1"><?php echo($bio)?></textarea>
              </div>
  
              <div class="list1">
                <label class="label1" for="study">Study</label>
                <textarea name='study' id="study" class="input1"><?php echo($study)?></textarea>
              </div>
              <div class="list1">
                <label class="label1" for="interest">
                  Interests
                </label>
                <textarea name='interest' id="interest" class="input1" type="text"><?php echo($interest)?></textarea>
              </div>
              <div class="list1">
                <label class="label1" for="employstatus">
                  Current Employment Status</label>
                <div class="select-box">
                  <select name="employ_status" id="employstatus">
                  <?php
                  if($employ_status==='Employed'){
                  ?>
                    <option value="Employed" >Employed</option>
                    <option value="Unemployed" >Unemployed</option>
                    <?php
                  } else {
                    ?>
                    <option value="Unemployed" >Unemployed</option>
                    <option value="Employed" >Employed</option>
                    <?php
                    }
                
                  ?>
                  </select>
                </div>
              </div>
              <div class="list1">
                <label class="label1" for="dob">Date of Birth</label>
                <input id="dob" name='dob' class="input1" type="text" value='<?php echo $dob;?>'/>
              </div>
              <div class="list1">
                <label class="label1" for="contactinfo">Contact Info</label>
                
                <input id="contactinfo" name='phone' class="input1" placeholder="Contact Number" type="tel" value='<?php echo $phone;?>'/>
              </div>
  
              <div class="list1">
                <label class="label1" for="experiences">Experiences</label>
                <textarea id="experiences" name='experience' class="input1"><?php echo $experience;?></textarea>
              </div>
              <div class="list1">
                <label class="label1" for="skills">Skills</label>
                <textarea id="skills" name='skills' class="input1"><?php echo $skills;?></textarea>
              </div>
              <!-- <div class="list1">
                <label class="label1" for="password">Change Password</label>
                <input id="password" class="input1" type="password" placeholder="Current Password" />
                <input id="password"class="input1" type="password" placeholder="New Password" />
                <input id="password" class="input1" type="password" placeholder="Confirm New Password" />
              </div> -->
              
          <div class="down-button">
            <div>
              <button class="button-secondary" type="submit" name='update'>Update Info
              </button>
              <!-- <button class="button-tertiary" type="submit" class="next">Create Resume
              </button> -->
            </div>
          </div>
        </form>
        <hr />
      </div>
    </div>
  </div>
</body>

</html>