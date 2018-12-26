<?php
  include 'database/db.php';
  $db = new Database();
  $con = $db->con;
  $sql = "select * from posts limit 10";
  $res = mysqli_query($con,$sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
  <link rel="stylesheet" href="css/main.css">
  <title>Kam Nepal | Dashboard</title>
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
				<p class="prof-name">Name</p>
				<hr>
				<p class="prof-employ">Employment details</p>
				<hr>
				<p class="prof-bio">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Distinctio, at!</p>
				<hr>
			</div>
        </section>
        <section class="dashboard-middle">
            <div class="create-post">
                <form action="dashboard.php" method="POST">
                    <h2>Whats on your mind?</h2>
                    <input type="text" placeholder="Title of your post">
                    <textarea class="fr-view" name="createpost" id="" cols="30" rows="10" placeholder="Body of your post"></textarea>
                    <div class="create-button">
                      <!-- <button class="button-primary">Add Media files</button> -->
                      <input type="file" name="" id="">
                      <button class="button-tertiary">Create Post</button>
                    </div>
                </form>
            </div>
            <div class="actual-post">
              <?php
              while($row=mysqli_fetch_assoc($res)){
                echo '<div class="job">
              <div class="job-title"><a href="javascript:;" id="'.$row['id'].'"class="links jobPosts">'.$row['title'].'</a></div>
              <div class="job-body">'.$row['body'].'</div>
              <div class="job-by">
              <span class="job-name"><a href="">ABC Company</a></span>
              <span class="job-date">'.$row['updated_at'].'</span>
              </div>
              </div>';
              }
              ?>
            </div>
        </section>
        <section class="dashboard-right">
            <div class="dashboard-comp">
				<div class='company-list'>
					<h2>Recommended Companies</h2>
					<?php for ($i=1 ; $i <=5 ; ++$i)
					{ if ($i < 10){
						echo '<div class="comp-card"><div class="company-name">
									<span class="badge">0'.$i. '</span>
									<a href="">Company ABC</a>
									<p class="company-bio">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem iure assumenda officiis sapiente voluptatibus aperiam alias dignissimos cupiditate, facilis dolore adipisci odio, dolorum quasi veniam molestiae repellat voluptatem libero doloribus?</p>
							</div></div>'; } else { echo '<div class="company-name">
								<span class="badge">'.$i. '</span>
								<a href="">Company ABC</a>
								<p class="company-bio">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem iure assumenda officiis sapiente voluptatibus aperiam alias dignissimos cupiditate, facilis dolore adipisci odio, dolorum quasi veniam molestiae repellat voluptatem libero doloribus?</p>
							</div></div>'; } }?>
				</div>
			</div>
        </section>
  </div>
  <?php require('./includes/footer.php')?>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script src="/js/app.js"></script>
</body>
</html>