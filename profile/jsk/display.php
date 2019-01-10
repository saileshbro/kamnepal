<?php
require '../../database/db.php';
$db = new Database();
$con = $db->con;
$user_id = cleanse($_GET['user_id']) ?? '';
$type = getColumn("select type from user where id='$user_id'", 'type');
if ($type === "Employer") {
  header("Location: ../emp/display.php?user_id=" . $user_id);
}
$email = getColumn("select email from user where id='$user_id'", "email");
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
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="../../css/main.css">
  <title>Kam Nepal</title>
</head>

<body onload="document.getElementById('about').click();$('#about').trigger('click');">
<div class='modal-message'>
  <div class='message-body'>
    <a class='modal-title' onclick="$('.modal-message').fadeOut();">&times;</a>
    <h2>Send Message</h2>
    <textarea name="message" id="message" cols="30" rows="10" placeholder="Enter your message here" ></textarea>
    <a href="javascript:;" class="links" id="sendTheMessage"> <i class="fab fa-telegram-plane"></i>Send</a>
  </div>
</div>
</div>
<div class="modal-post-form">
  <div class='create-post'>
    <form id='createPost'>
      <a class='modal-title' onclick="$('.modal-post-form').fadeOut();$('.inp-grp').attr('id','none')">&times;</a>
      <h2>Edit Post</h2>
      <div class='inp-grp' style='width:100%;'>
      <input type='text' id='title' placeholder='Title of your post'>
    </div>
    <div style='margin: 0 20px; margin-bottom:20px; border-radius:5px;'>
      <textarea class='fr-view' name='createpost' id='editor' cols='30' style='display:none;' rows='10' placeholder='Body of your post'></textarea>
    </div>
    <div class='create-button'>
      <input type='file' id='file' name='file'>
      <a href='javascript:;' id='create-button' class='button-primary'>Update</a>
    </div>
    </form>
  </div>
</div>
<?php include '../../index-nav.php'; ?>
<?php require '../../includes/modal-education.php'; ?>
<?php require '../../includes/modal-experience.php'; ?>
<div class='modal' id="modal"></div>
<div class="Profile-main-body">
  <div class="profile-left">
    <div class="prof-head-img">
       <img src=<?php echo "../../" . getColumn("select profile_img from profile where user_id='$user_id'", "profile_img"); ?> alt="profile-pic">
    </div>
    <div class="prof-body-part-left">
      <div class="left-elements">
        <div class="left-heading">
          <div class='title'>
            <h3 class="one">Education</h3>
            <a href="javascript:;" class="two" id="education-more">+</a>
          </div>
          <div class='body'>
          <?php $sql = "select * from education where user_id =' $user_id ' limit 2";
          $res = mysqli_query($con, $sql);
          while ($row = mysqli_fetch_array($res)) {
            echo "<h4 class='first-line'>" . $row['course_title'] . "</h4>
            <p class='second-line'>" . $row['inst_name'] . "</p>";
          }
          ?>
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
          <?php $sql = "select * from experience where user_id =' $user_id ' limit 2";
          $res = mysqli_query($con, $sql);
          while ($row = mysqli_fetch_array($res)) {
            echo "<h4 class='first-line'>" . $row['emp_title'] . "</h4>
            <p class='second-line'>" . $row['emp_comp'] . "</p>";
          }
          ?>
          </div>
        </div>
      </div>
      <!-- <hr> -->
      <div class="left-bottom">
        <h1 class="left-bottom-heading">Skills</h1>
        <div class='skill-set'>
          <div>
          <?php
          $sql = "select skill_type from skills where user_id = '$user_id'";
          $res = mysqli_query($con, $sql);
          while ($row = mysqli_fetch_array($res)) {
            echo "<h3 class='bottom-main'>" . $row['skill_type'] . "</h3>";
          }
          ?>
          </div>
          <div>
          <?php
          $sql = "select skill_list from skills where user_id = '$user_id'";
          $res = mysqli_query($con, $sql);
          while ($row = mysqli_fetch_array($res)) {
            echo "<h3 class='bottom-main'>" . implode(',   ', explode(',', $row['skill_list'])) . " </h3>";
          }
          ?>
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
      <?php
      if ($user_id !== $userId) {
        echo "<a href='javascript:;' class='message' onclick='sendMessage();' id='sendMessage'><i class='far fa-envelope'></i></i>Message</a>";
      }
      ?>
      <?php
      if ($user_id === $userId) {
        echo "<a href='update.php' class='message'><i class='far fa-edit'></i></i>Edit Profile</a>";
      }
      ?>
      <a href="javascript:;" id='printCV' class="message"><i class="fas fa-print"></i></i>Print CV</a>
    </div>
    <div class="prof-head-switch">
        <a class="prof-timeline" id="timeline" href="javascript:;"><i class="far fa-eye"></i>Timeline </a>
        <a class="prof-about when" class="when"id="about" href="javascript:;"><i class="far fa-user"></i>About</a>
    </div>


    <div class="prof-body-part-right">
      <div id="timeline-right">
      <?php
      $sql = "select * from posts where user_id='$user_id'  ORDER BY updated_at DESC";
      $res = mysqli_query($con, $sql);
      while ($row = mysqli_fetch_array($res)) {
        echo '<div class="job" id = "job' . $row['id'] . '">
                  <div class="head-ele">
                  <div class="job-title"><a href="javascript:;" id="' . $row['id'] . '"class="links jobPosts">' . $row['title'] . '</a></div>
                  ';
        if ($userId === $user_id) {
          echo ('<div class="post-buttons">
                    <a id= "edit' . $row['id'] . '" class="edit" onclick="editPost(this.id);"><i class="fas fa-edit fa-2x"></i></a>
                    <a id= "delete' . $row['id'] . '"  onclick="displayedit(this.id);" class="delete"><i class="fas fa-trash fa-2x"></i></a>
                    <a id= "check' . $row['id'] . '"  onclick="removePost(this.id);" class="check"><i class="fas fa-check fa-2x"></i></a>
                </div>');
        }
        echo '
              </div>
              <div class="job-body">' . html_entity_decode(htmlspecialchars_decode($row['body'])) . '</div>
              <div class="job-by">
              <span class="job-name"><a href="javascript:;">' . $fname . '</a></span>
              <span class="job-date">' . $row['updated_at'] . '</span>
              </div>
              </div>';
      }
      ?>
      </div>
      <div id="about-right">
        <div id='ext'>
        <h1>Contact</h1>
        <!-- to edit here -->
        <div class="right-elements">
        <span class="heading"><i class="fas fa-phone"></i>Phone</span>
        <span class="text"><?php echo $phone; ?><span>
        </div>
        <div class="right-elements">
        <span class="heading"><i class="fas fa-at"></i>Email</span>
        <span class="text"><?php echo $email; ?><span>
        </div>
        </div>
        <!-- to edit here -->
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
<?php include '../../includes/footer.php' ?>
<script src="//cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
<script> user_id = "<?= $user_id ?>"</script>
<script src="../../js/app.js"></script>
<script>
    var createpost = CKEDITOR.replace('createpost', {
        extraAllowedContent: 'div',
        height: 250,
        removePlugins: "elementspath,about,sourcearea,resize,pastefromword,pastetext,paste",
        removeButtons: 'Paste,Cut,Copy,Undo,Redo,Anchor'
        // extraPlugins: "justify"
        // remove here
      });
      createpost.on('instanceReady', function () {
        // Output self-closing tags the HTML4 way, like <br>.
        this.dataProcessor.writer.selfClosingEnd = '>';

        // Use line breaks for block elements, tables, and lists.
        var dtd = CKEDITOR.dtd;
        for (var e in CKEDITOR.tools.extend({}, dtd.$nonBodyContent, dtd.$block, dtd.$listItem, dtd.$tableContent)) {
          this.dataProcessor.writer.setRules(e, {
            indent: false,
            breakBeforeOpen: true,
            breakAfterOpen: true,
            breakBeforeClose: true,
            breakAfterClose: true
          });
        }
      });
      function sendMessage(){
        $('.modal-message').fadeIn();
      }
      $("#sendTheMessage").click(() => {
        $.ajax({
          type: "POST",
          url : "../../messages/sendtojsk.php",
          data: {
            reciever: user_id,
            message: $('#message').val()
          },
          success: (data)=>{
            $('.modal-message').fadeOut();
          }
        });
      });
</script>
<script>
  var src = "<?= $profileImg ?>";
  src = "../."+src;
  $('#nav-pro-img').attr("src",src);
  $('.dropdown-profile-mid img').attr("src",src);
</script>
</body>
</html>
