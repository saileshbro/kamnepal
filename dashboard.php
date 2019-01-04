<?php
include "auth/authenticate.php";
include 'database/db.php';
$db = new Database();
$con = $db->con;
$user_id = getColumn("select id from user where email='$email'", 'id');
$type = getColumn("select type from user where email='$email'", 'type');
$fname = getColumn("select fname from profile where user_id ='$user_id'", "fname");
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
					<img src="img/profile/profile.jpg"alt="profile-pic">
				</div>
				<p class="prof-name"><?php echo $fname; ?></p>
				<hr>
				<p class="prof-employ">Employment details</p>
				<hr>
				<p class="prof-bio">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Distinctio, at!</p>
				<hr>
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
                      ?>
                    </div>
                    <div style="margin: 0 20px; margin-bottom:20px; border-radius:5px;">
                    <textarea class="fr-view" name="createpost" id="editor" cols="30" style="display:none;" rows="10" placeholder="Body of your post"></textarea>
                    </div>
                    <div class="create-button">
                      <!-- <button class="button-primary">Add Media files</button> -->
                      <input type="file" name="file" id="">
                      <a href='javascript:;' id='create-button' class="button-primary">Create Post</a>
                    </div>
                </div>
            </form>
            <div class="actual-post">
              <!-- show jobs here -->
              <?php
              if ($type === 'Jobseeker') {

              }
              ?>
              <!-- <div class="job">
                <div class="job-title"><a href="javascript:;" id="' . $row['id'] . '"class="links jobPosts">' . $row['title'] . '</a></div>
                  <div class="job-body">' . $row['body'] . '</div>
                    <div class="job-by">
                      <span class="job-name"><a href="">ABC Company</a></span>
                      <span class="job-date">' . $row['updated_at'] . '</span>
                  </div>
                </div>
              </div> -->
        </section>
        <section class="dashboard-right">
            <div class="dashboard-comp">
				<div class='company-list'>
					<h2>Recommended Companies</h2>
					<?php for ($i = 1; $i <= 5; ++$i) {
      if ($i < 10) {
        echo '<div class="comp-card"><div class="company-name">
									<span class="badge">0' . $i . '</span>
									<a href="">Company ABC</a>
									<p class="company-bio">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem iure assumenda officiis sapiente voluptatibus aperiam alias dignissimos cupiditate, facilis dolore adipisci odio, dolorum quasi veniam molestiae repellat voluptatem libero doloribus?</p>
							</div></div>';
      } else {
        echo '<div class="company-name">
								<span class="badge">' . $i . '</span>
								<a href="">Company ABC</a>
								<p class="company-bio">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem iure assumenda officiis sapiente voluptatibus aperiam alias dignissimos cupiditate, facilis dolore adipisci odio, dolorum quasi veniam molestiae repellat voluptatem libero doloribus?</p>
							</div></div>';
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
    $('.create-button .button-primary').click(()=>{
      var title = document.getElementById('title').value;
      var category = $('#createPost select').val();
        $.ajax({
        type: 'POST',
        url: 'createpost.php',
        data: {
          user_id: user_id,
          title: title,
          body: createpost.getData(),
          category: category
        },
        success: (data)=>{
          alert(data);
        }
      });
    });
  </script>
  <script src="/js/app.js"></script>
</body>
</html>