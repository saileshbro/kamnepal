<?php
include "auth/authenticate.php";
include 'database/db.php';
$db = new Database();
$con = $db->con;
$user_id = getColumn("select id from user where email='$email'", 'id');
$type = getColumn("select type from user where email='$email'", 'type');
$fname = getColumn("select fname from profile where user_id ='$user_id'", "fname");
$interest = getColumn("select interest from profile where user_id ='$user_id'", "interest");
$bio = getColumn("select bio from profile where user_id ='$user_id'", "bio");
$jobsql = "select  profile.id, profile.fname, profile.bio from profile,user where profile.user_id= user.id and user.type='Jobseeker' limit 10";
$jobres = mysqli_query($con, $jobsql);
$empsql = "select  profile.id, profile.fname, profile.bio from profile,user where profile.user_id= user.id and user.type='Employer' limit 10";
$empres = mysqli_query($con, $empsql);
if ($type == 'Jobseeker') {
  $category = getColumn("select category from profile where user_id='$user_id'", 'category');
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
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
  <link rel="stylesheet" href="css/main.css">
  <title>Kam Nepal | Dashboard</title>
  <style>
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
          // echo "<p class='prof-bio'>$bio</p>  ";
        } else {
          echo "<p class='prof-employ'>Employment details</p>";
          echo "<hr>";
          echo "<p class='prof-bio'>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Distinctio, at!</p>  ";
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
                        echo "<select name='category' ><option value='Jobs Category' selected='true' disabled='disabled'>Category</option>";
                        $sql = "select * from category";
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
              <!-- show jobs here -->
              <?php
              if ($type === 'Jobseeker') {
                $sql = "SELECT posts.*,profile.fname FROM posts,user,profile WHERE posts.category='$category' AND user.id=posts.user_id AND user.id=profile.user_id AND user.type='Employer' ORDER BY updated_at DESC";
                $res = mysqli_query($con, $sql);
                if ($res) {
                  while ($row = mysqli_fetch_array($res)) {
                    echo "<div class='job'>
                            <div class='job-title'><a href='javascript:;' id='" . $row['id'] . "'class='links jobPosts'>" . $row['title'] . "</a>
                            </div>
                            <div class='job-body'>" . html_entity_decode(htmlspecialchars_decode($row['body'])) . "
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
          if ($type === 'Jobseeker') {
            $i = 1;
            while ($row = mysqli_fetch_assoc($empres)) {
              echo '<div class="comp-card">
                      <div class="company-name">
                        <span class="badge">0' . $i . '</span>
                        <a href="">' . $row['fname'] . '</a>
                        <p class="company-bio">' . $row['bio'] . '</p>
                      </div>
                    </div>';
              $i++;
            }
          } else if ($type === 'Employer') {
            $i = 1;
            while ($row = mysqli_fetch_assoc($jobres)) {
              echo '<div class="comp-card">
                      <div class="company-name">
                        <span class="badge">0' . $i . '</span>
                        <a href="">' . $row['fname'] . '</a>
                        <p class="company-bio">' . $row['bio'] . '</p>
                      </div>
                    </div>';
              $i++;
            }
          } ?>
				</div>
			</div>
        </section>
  </div>
  <?php require('./includes/footer.php') ?>
  <script src="//cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
  <script> user_id = "<?= $user_id ?>";</script>
  <script>
    var createpost = CKEDITOR.replace('createpost', {
      extraAllowedContent: 'div',
      height: 250,
      removePlugins: "elementspath,about,sourcearea,resize,pastefromword,pastetext,paste",
      removeButtons: 'Paste,Cut,Copy,Undo,Redo,Anchor'
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
    $('.create-button .button-primary').click(()=>{
      var title = document.getElementById('title').value;
      var category = $('#createPost select').val();
      var fileToUpload = $('#file').prop('files')[0];
      var form = new FormData();
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
        data: form,
        success: (data)=>{
          document.getElementById('title').value= "";
          createpost.setData("");
          $('#cke_editor').fadeOut();
        }
      });
    });
    function gotoProfile(){
      if("<?= $type ?>"==="Jobseeker"){
        location.href = "profile/jsk/display.php?user_id="+"<?= $user_id ?>";
      }else{
        location.href = "profile/emp/display.php?user_id="+"<?= $user_id ?>";
      }
    }
  </script>
  <script src="/js/app.js"></script>
</body>
</html>