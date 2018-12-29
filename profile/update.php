<?php
require('../auth/authenticate.php');
require('../database/db.php');
$db = new Database;
$con = $db->con;
$user_id = getColumn("SELECT id FROM user WHERE email='$email'", "id");
$educationCount = getColumn("SHOW TABLE STATUS LIKE 'education'", "Auto_increment");
$experienceCount = getColumn("SHOW TABLE STATUS LIKE 'experience'", "Auto_increment");
$skillCount = getColumn("SHOW TABLE STATUS LIKE 'skills'", "Auto_increment");
$sql = "select * from profile where user_id='$user_id'";
$res = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($res)) {
  $fname = $row['fname'];
  $gender = $row['gender'];
  $dob = $row['dob'];
  $address = $row['address'];
  $phone = $row['phone'];
// $profile_img=$row['profile_img'];
  $employ_status = $row['employ_status'];
  $interest = $row['interest'];
  $bio = $row['bio'];
  $updated_at = $row['updated_at'];
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" href="../css/main.css" />
    <title>Kam Nepal</title>
  </head>
  <body>
    <?php include "../index-nav.php"; ?>
    <div class="containerProfile">
      <div class="profileUpdate">
        <div class="headingpart">
          <h1 class='heading-primary'>Update Profile</h1>
        </div>
        <hr>
        <div class="infopart">
          <div class="form1">
            <div class="list2">
                <img id="avatar" class="list2__image" src="../img/profile/profile.jpg" alt="Avatar"/>
            </div>
            <div class="list1">
              <label class="label1" for="name">Name</label>
              <input name='fname' class="input1" id="fname" type="text" value="<?php echo $fname ?>">
            </div>
            <div class="list1">
              <label class="label1" for="gender">Gender</label>
              <div class="radios">
              <div class="radios__item">
                  <input name="gender" class="input2" id="male" type="radio" name="gender" value="Male" <?php echo ($gender === 'male' || $gender === "Male") ? 'checked' : ''; ?> />
                  <label class="label2" for="male">Male</label>
                </div>
                <div class="radios__item">
                  <input name="gender" class="input2" id="female" type="radio" name="gender" <?php echo ($gender === 'female' || $gender === "Female") ? 'checked' : ''; ?> value="Female" />
                  <label class="label2" for="female">Female</label>
                  </div>
                <div class="radios__item">
                  <input name="gender" class="input2" id="others" type="radio" <?php echo ($gender === 'others' || $gender === "Others") ? 'checked' : ''; ?> name="gender" value="other" />
                  <label class="label2" for="others">Others</label>
                </div>
              </div>
            </div>
            <div class="list1">
              <label class="label1" for="dob">Date of Birth</label>
              <input id="dob" name='dob' class="input1 dob" type="text" value='<?php echo $dob; ?>'/>
            </div>
            <div class="list1">
              <label class="label1" for="address">Address</label>
              <textarea name='address' id="address" class="input1"><?php echo ($address) ?></textarea>
            </div>
            <div class="list1">
              <label class="label1" for="contactinfo">Contact Info</label>
              <input id="contactinfo" name='phone' class="input1" placeholder="Contact Number" type="tel" value='<?php echo $phone; ?>'/>
            </div>
            <div class="list1">
              <label class="label1" for="bio">Bio</label>
              <textarea name='bio' id="bio" class="input1"><?php echo ($bio) ?></textarea>
            </div>
            <div class="list1">
              <label class="label1" for="employstatus">Current Employment Status</label>
              <div class="select-box">
                <select name="employ_status" id="employstatus">
                  <option value="Employed" <?php echo ($employ_status === 'Employed') ? "selected='true'" : ""; ?>>Employed</option>
                  <option value="Unemployed" <?php echo ($employ_status === 'Unemployed') ? "selected='true'" : ""; ?> >Unemployed</option>
                </select>
              </div>
            </div>
            <div class="list1">
              <label class="label1" for="interest">Interests</label>
              <textarea name='interest' id="interest" class="input1" type="text"><?php echo ($interest) ?></textarea>
            </div>
            <div class="list1">
              <label class="label1" for="study">Education</label>
              <a href="javascript:;" id="addEducation" class='links'>Add Education</a>
              <div id="education">
                <?php
                $sql = "select * from education where user_id = '$user_id'";
                $res = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_array($res)) {
                  echo '<div class="cvform education-' . $row['id'] . '">';
                  echo '<input type="text" name="course-title-' . $row['id'] . '" placeholder="Your course name" value="' . $row['course_title'] . '" >';
                  echo '<input type="text" name="course-inst-' . $row['id'] . '" placeholder="Your Institution&apos;s name" value="' . $row['inst_name'] . '" >';
                  echo '<input type="text" name="course-begin-' . $row['id'] . '" placeholder="Course start year" value="' . $row['start_year'] . '" >';
                  echo '<input type="text" name="course-end-' . $row['id'] . '" placeholder="Course ended. Blank for present" value="' . $row['end_year'] . '" >';
                  echo '<textarea name="course-detail-' . $row['id'] . '" id="" cols="30" rows="10" placeholder="Add your course Details">' . $row['details'] . '</textarea>';
                  echo '<a href="javascript:;" onclick="removeEduPressed(this.id);" class="links remedu" id="edu-' . $row['id'] . '" >Remove</a>';
                  echo '</div>';
                }
                ?>
              </div>
            </div>
            <div class="list1">
              <label class="label1" for="study">Experience</label>
              <a href="javascript:;" id="addExperience" class="links">Add Experience</a>
              <div id="experience">
                <?php
                $sql = "select * from experience where user_id ='$user_id'";
                $res = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_array($res)) {
                  echo '<div class="cvform experience-' . $row['id'] . '">';
                  echo '<input type="text" name="emp-title-' . $row['id'] . '" placeholder="Job title | Designation" value="' . $row['emp_title'] . '" >';
                  echo '<input type="text" name="emp-comp-' . $row['id'] . '" placeholder="Add the company&apos;s name." value="' . $row['emp_comp'] . '" >';
                  echo '<input type="text" name="emp-begin-' . $row['id'] . '" placeholder="Start year" value="' . $row['emp_start'] . '" >';
                  echo '<input type="text" name="emp-end-' . $row['id'] . '" placeholder="End Year | Blank for Current" value="' . $row['emp_end'] . '" >';
                  echo '<textarea name="emp-detail-' . $row['id'] . '" cols="30" rows="10" placeholder="Explain your role">' . $row['emp_details'] . '</textarea>';
                  echo '<a href="javascript:;" onclick="removeExpPressed(this.id);" class="links remexp" id="emp-' . $row['id'] . '">Remove</a>';
                  echo '</div>';
                }
                ?>
              </div>
            </div>
            <div class="list1 skill-group">
              <label class="label1" for="skills">Skills</label>
              <a href="javascript:;" id="addSkill" class="links">Add Skills</a>
              <?php
              $sql = "select * from skills where user_id ='$user_id'";
              $res = mysqli_query($con, $sql);
              while ($row = mysqli_fetch_array($res)) {
                echo '<div id="skill-set">';
                echo '<div class="skillinp skills-' . $row['id'] . '">';
                echo '<div class="inpgrp">';
                echo '<input class="skills" name="skill-type-' . $row['id'] . '" value="' . $row['skill_type'] . '" class="input1" placeholder="Add skill type. Eg. Language">';
                echo '<input class="skills" name="skill-list-' . $row['id'] . '" value="' . $row['skill_list'] . '" class="input1" placeholder="Add skills. Eg. English, French, Spanish">';
                echo '</div>';
                echo '<a href="javascript:;" onclick="removeSkillPressed(this.id);" class="links remexp" id="emp-' . $row['id'] . '" >Remove</a>';
                echo '</div>';
                echo '</div>';
              }
              ?>
            </div>
            <div class="down-button">
              <div>
                <button class="button-secondary" id="updateProfile" name='update'>Update Info</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php require('../includes/footer.php') ?>
    <script>
      val1 = "<?= $educationCount ?>";
      val2 = "<?= $experienceCount ?>";
      val3 = "<?= $skillCount ?>";
    </script>
    <script type="text/javascript" src="../js/app.js"></script>
  </body>
</html>