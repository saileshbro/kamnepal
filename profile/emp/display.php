<?php
require '../../database/db.php';
$db = new Database();
$con = $db->con;
$user_id = cleanse($_GET['user_id']) ?? '';
$type = getColumn("select type from user where id='$user_id'", 'type');

if ($type === "Jobseeker") {
  header("Location: ../jsk/display.php?user_id=" . $user_id);
}
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
<body>
<?php require '../../includes/modal-education.php'; ?>
<?php require '../../includes/modal-experience.php'; ?>
<?php include '../../index-nav.php'; ?>
<div id='modal' class='modal' ></div>
<div class='modal-post-form'>
<div class='create-post'>
  <form id='createPost'>
    <a class='modal-title' onclick="$('.modal-post-form').fadeOut();$('.inp-grp').attr('id','none')">&times;</a>
    <h2>Edit Post</h2>
    <div class='inp-grp' id="none" style='width:95%;'>
      <input type='text' id='title' placeholder='Title of your post'>
      <select name='category' id='category' >
        <option value='Jobs Category' disabled>Category
          <option value=1>Architecture / Interior Designing
          <option value=2>Construction / Engineering / Architects
          <option value=3>Commercial / Logistics / Supply Chain
          <option value=4>Creative / Graphics / Designing
          <option value=5>Hospitality
          <option value=6>NGO / INGO / Social work
          <option value=7>Teaching / Education
          <option value=8>General Mgmt. / Administration / Operations
          <option value=9>Healthcare / Pharma / Biotech / Medical / R&amp;D
          <option value=10>Human Resource /Org. Development
          <option value=11>Sales / Public Relations
          <option value=12>Research and Development
          <option value=13>Production / Maintenance / Quality
          <option value=14>Marketing / Advertising / Customer Service
          <option value=15>Legal Services
          <option value=16>Accounting / Finance
          <option value=17>Banking / Insurance /Financial Services
          <option value=18>Fashion / Textile Designing
          <option value=19>Secretarial / Front Office / Data Entry
          <option value=20>IT &amp; Telecommunication
          <option value=21>Protective / Security Services
          <option value=22>Journalism / Editor / Media
          <option value=23>Others
        </select>
      </div>
    <div style='margin: 0 20px; margin-bottom:20px; border-radius:5px;'>
    <textarea class='fr-view' name='createpost' id='editor' cols='30' style='display:none;' rows='10' placeholder='Body of your post'></textarea>
  </div>
  <div class='create-button'>
    <input type='file' name='file'>
    <a href='javascript:;' id='create-button' class='button-primary'>Update</a>
  </div>
</form>
</div>
</div>
<div class="Profile-main-body">
  <div class="profile-left">
    <div class="prof-head-img2">
       <img src="../../img/profile/profile.jpg" alt="profile-pic">
       <?php
      if ($user_id === $userId) {
        echo "<a href='update.php' class='message'><i class='far fa-edit'></i></i>Edit Profile</a>";
      }
      ?>
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
          <span class="text" id='num-post-org'><?php echo mysqli_num_rows(mysqli_query($con, "select * from posts where user_id='$user_id'")); ?></span>
        </div>
      </div>
    </div>
  </div>
  <div class="profile-right" style="max-height: 64.8rem;">
  <?php
  $sql = "select * from posts where user_id='$user_id'";
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
  </div>
</div>
<?php include '../../includes/footer.php' ?>
<script> user_id = "<?= $user_id ?>"</script>
<script src="//cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
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
</script>
</body>

</html>
