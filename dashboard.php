<?php
include "auth/authenticate.php";
include 'database/db.php';
$db = new Database();
$con = $db->con;
// get userid of logged in user
$user_id = getColumn("select id from user where email='$email'", 'id');
// get type of user
$type = getColumn("select type from user where email='$email'", 'type');
// get full name
$fname = getColumn("select fname from profile where user_id ='$user_id'", "fname");
// get interests
$interest = getColumn("select interest from profile where user_id ='$user_id'", "interest");
// get bio
$bio = getColumn("select bio from profile where user_id ='$user_id'", "bio");
// get category
$category = getColumn("select category from profile where user_id='$user_id'", 'category');
// get details of jobseeker
$jobsql = "select  profile.id, profile.fname, profile.bio from profile,user where profile.user_id= user.id and user.type='Jobseeker'and profile.category='$category' limit 10";
$jobres = mysqli_query($con, $jobsql);
// get details of employer
$empsql = "select  profile.id, profile.fname, profile.bio from profile,user where profile.user_id= user.id and user.type='Employer' and profile.category='$category' limit 10";
$empres = mysqli_query($con, $empsql);
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
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
  <link rel="stylesheet" href="css/main.css">
  <title>Kam Nepal | Dashboard</title>
  <style>
    /* display hidden by default */
    #cke_editor {
      display: none;
    }
  </style>
</head>
<body>
  <div class='modal' id="modal"></div>
  <?php
  require 'index-nav.php';
  ?>
  <div class="dashboard-body" style="z-index=1;">
        <section class="dashboard-left">
			<div class="dashboard-card">
				<div class="prof-img">
          
					<img src=<?php echo $profileImg ?> alt="profile-pic">
				</div>
				<p class="prof-name" style="cursor: pointer;" onclick="gotoProfile();"><?php echo $fname; ?></p>
        <hr>
        <?php
        if ($type === 'Jobseeker') {
          echo "<p class='prof-employ'>$interest</p>";
          echo "<hr>";
          echo "<p class='prof-bio'>" . substr($bio, 0, 167) . " . . . .</p>  ";
        } else {
          echo "<p class='prof-bio'>" . substr($bio, 0, 167) . " . . . .</p>  ";
        }
        ?>
			</div>
        </section>
        <section class="dashboard-middle">
            <div class="create-post">
              <form id="createPost">
                <h2>Whats on your mind?</h2>
                <?php if ($type === 'Jobseeker') {
                  echo "<div class='inp-grp' style='width:100%;'>";
                } else {
                  echo "<div class='inp-grp' style='width:95%;'>";
                }
                ?>
                      <input type="text" id="title" placeholder="Title of your post">
                      <?php
                      if ($type === 'Employer') {
                        echo "<select name='category' required</select><option value='Jobs Category' selected='true' disabled='disabled'>Category</option>";
                        $sql = "select * from category order by name asc";//get category list from database
                        $res = mysqli_query($con, $sql);
                        if ($res) {
                          while ($row = mysqli_fetch_array($res)) {
                            echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
                          }
                          echo "</select>";
                        }

                      }
                      echo ("</div>")
                      ?>
                <div style="margin: 0 20px; margin-bottom:20px; border-radius:5px;">
                  <textarea class="fr-view" name="createpost" id="editor" cols="30" style="display:none;" rows="10" placeholder="Body of your post"></textarea>
                </div>
                <div class="create-button">
                  <input type="file" id="file">
                  <a href='javascript:;' id='create-button' class="button-primary">Create Post</a>
                </div>
              </form>
            </div>
            <div class="actual-post">
            <?php
            if ($type === 'Jobseeker') {
              // display employer posts for jobseeker accorging to category
              $sql = "SELECT posts.*,profile.fname FROM posts,user,profile WHERE posts.category='$category' AND user.id=posts.user_id AND user.id=profile.user_id AND user.type='Employer' ORDER BY updated_at DESC";
              $res = mysqli_query($con, $sql);
              if ($res) {
                while ($row = mysqli_fetch_array($res)) {
                  // display jobs
                  echo "<div class='job'>
                            <div class='job-title'><a href='posts/index.php?id=" . $row['id'] . "' id='" . $row['id'] . "'class='jobPosts'>" . $row['title'] . "</a>
                            </div>
                            <div class='job-by'>
                              <span class='job-name'><a href='profile/emp/display.php?user_id=" . $row['user_id'] . "'>" . $row['fname'] . "</a></span>
                              <span class='job-date'>" . $row['updated_at'] . "</span>
                            </div>
                          </div>";
                }
              } else {
                // if no posts
                echo "<div class='job'>
                          <div class job-body>No Posts Available</div>
                        </div>";
              }
            } else if ($type === 'Employer') {
              // display jobseekers posts for employer
              $sql = "SELECT posts.*,profile.fname FROM posts,user,profile WHERE posts.category='$category' AND user.id=posts.user_id AND user.id=profile.user_id AND user.type='Jobseeker' ORDER BY updated_at DESC";
              $res = mysqli_query($con, $sql);
              if ($res) {
                while ($row = mysqli_fetch_array($res)) {
                  echo "<div class='job'>
                            <div class='job-title'><a href='posts/index.php?id=" . $row['id'] . "' id='" . $row['id'] . "'class='jobPosts'>" . $row['title'] . "</a>
                            </div>
                            <div class='job-by'>
                              <span class='job-name'><a href='profile/emp/display.php?user_id=" . $row['user_id'] . "'>" . $row['fname'] . "</a></span>
                              <span class='job-date'>" . $row['updated_at'] . "</span>
                            </div>
                          </div>";
                }
              } else {
                echo "<div class='job'>
                          <div class job-body>No Posts Available</div>
                        </div>";
              }
            }
            ?>
        </section>
        <section class="dashboard-right">
            <div class="dashboard-comp">
				<div class='company-list'>
        <?php echo ($type === 'Jobseeker') ? "<h2>Recommended Companies</h2>" : "<h2>Potential Candidates</h2>"; ?>
        <?php 
        // list of recommendations
        if ($type === 'Jobseeker') {
          // if jobseeker display recommended companies
          if ($empres) {
            $i = 1;
            while ($row = mysqli_fetch_assoc($empres)) {
              echo '<div class="comp-card">
                      <div class="company-name">
                        <span class="badge">0' . $i . '</span>
                        <a style="z-index:0" href="/profile/jsk/display.php?user_id=' . $row['id'] . '">' . $row['fname'] . '</a>
                        <p class="company-bio">' . $row['bio'] . '</p>
                      </div>
                    </div>';
              $i++;
            }
          } else {
            echo '<p id="No"><span>!</span>No Recommendations Found</p>';
          }
        } else if ($type === 'Employer') {
          if ($jobres) {
            // if jobseeker display recommended companies
            $i = 1;
            while ($row = mysqli_fetch_assoc($jobres)) {
              echo '<div class="comp-card">
                      <div class="company-name">
                        <span class="badge">0' . $i . '</span>
                        <a href="/profile/emp/display.php?user_id=' . $row['id'] . '">' . $row['fname'] . '</a>
                        <p class="company-bio">' . $row['bio'] . '</p>
                      </div>
                    </div>';
              $i++;
            }
          } else {
            echo '<p id="No"> <span>!</span>No Recommendations Found</p>';
          }
        } ?>
				</div>
			</div>
        </section>
  </div>
  <?php require('./includes/footer.php') ?>
  <!-- Include CK EDITOR -->
  <script src="//cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
  <script> user_id = "<?= $user_id ?>";</script>
  <!--**********************CK EDITOR CONFIGURATION***********************  -->
  <script>
    var createpost = CKEDITOR.replace('createpost', {
      extraAllowedContent: 'div',
      height: 250,
      removePlugins: "elementspath,about,sourcearea,resize,pastefromword,pastetext,paste",
      removeButtons: 'Paste,Cut,Copy,Undo,Redo,Anchor'
    });
    createpost.on('instanceReady', function () {
      this.dataProcessor.writer.selfClosingEnd = '>';
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
    // ********************* CREATE POST HERE********************************/
    $('.create-button .button-primary').click(()=>{
      // get title
      var title = document.getElementById('title').value;
      // get category of the post
      var category = $('#createPost select').val();
      // get the file to be ubloaded
      var fileToUpload = $('#file').prop('files')[0];
      var form = new FormData();//send it as form data
      form.append("user_id",user_id);
      form.append("title",title);
      form.append("body",createpost.getData());
      form.append("category",category);
      form.append("image",fileToUpload);
        $.ajax({
        type: 'POST',
        url: 'createpost.php',
        contentType: false,
        processData: false,
        data: form,//send form as a form data
        success: (data)=>{
          document.getElementById('title').value= ""; //clear the title
          createpost.setData("");//clear the ck editor
          $('#cke_editor').fadeOut();
        }
      });
    });
    //*********************************PROFILE NAVIGATION */
    function gotoProfile(){
      if("<?= $type ?>"==="Jobseeker"){
        location.href = "profile/jsk/display.php?user_id="+"<?= $user_id ?>";
      }else{
        location.href = "profile/emp/display.php?user_id="+"<?= $user_id ?>";
      }
    }
    // *****************message navigation*******************/
    function gotoMessage(){
      location.href="./messages";
    }
  </script>
  <script src="/js/app.js"></script>
</body>
</html>