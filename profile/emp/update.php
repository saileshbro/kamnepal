<?php
// UPDATE EMPLOYER PROFILE
include_once('../../auth/authenticate.php');
require('../../database/db.php');
$db = new Database;
$con = $db->con;
$user_id = getColumn("SELECT id FROM user WHERE email='$email'", "id");
$educationCount = getColumn("SHOW TABLE STATUS LIKE 'education'", "Auto_increment");
$experienceCount = getColumn("SHOW TABLE STATUS LIKE 'experience'", "Auto_increment");
$skillCount = getColumn("SHOW TABLE STATUS LIKE 'skills'", "Auto_increment");
$type = getColumn("select type from user where email='$email'", 'type');
if ($type === "Jobseeker") {
  header("Location: ../jsk/update.php");
}
$sql = "select * from profile where user_id='$user_id'";
$res = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($res)) {
  $fname = $row['fname'];
  $gender = $row['gender'];
  $dob = $row['dob'];
  $address = $row['address'];
  $phone = $row['phone'];
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
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" href="../../css/main.css" />
    <title>Kam Nepal</title>
  </head>
  <body>
    <?php include "../../index-nav.php"; ?>
    <div class="containerProfile">
      <div class="profileUpdate">
        <div class="headingpart">
          <h1 class='heading-primary'>Update Profile</h1>
        </div>
        <hr>
        <div class="infopart">
          <div class="form1">
            <div class="list2">
            <img id="avatar" class="list2__image" src=<?php echo "../." . $profileImg ?> alt="Avatar"/>
                <div id='edit-a'>
                  <i class="fas fa-pencil-alt fa-2x upload-button"></i>
                    <input class="file-upload" type="file" accept="image/*" style="display:none;" onchange="changeAvatar(this)"/>
                </div>
            </div>
            <div class="list1">
              <label class="label1" for="name">Name</label>
              <input name='fname' class="input1" id="fname" type="text" value="<?php echo $fname ?>">
            </div>
            <div class="list1">
              <label class="label1" for="dob">Date of Establishment</label>
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
              <label class="label1" for="bio">Details</label>
              <textarea name='bio' id="bio" class="input1"><?php echo ($bio) ?></textarea>
            </div>
            <div class="down-button">
              <div>
                <button class="button-secondary" id="updateEmp" name='update'>Update Info</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php require('../../includes/footer.php') ?>
    <script>
      function changeAvatar(data){
        var fileToUpload = $('.file-upload').prop('files')[0];
        var data = new FormData();
        data.append('image',fileToUpload);
        $.ajax({
          url:"../changeProfile.php",
          data: data,
          type: 'POST',
          contentType: false,
          processData: false,
          success: (data)=>{
            alert(data);
          }
        });
      }
    </script>
    <script>
  var src = "<?= $profileImg ?>";
  src = "../."+src;
  $('#nav-pro-img').attr("src",src);
  $('.dropdown-profile-mid img').attr("src",src);
</script>
    <script type="text/javascript" src="../../js/app.js"></script>
  </body>
</html>