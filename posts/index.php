<?php
include '../database/db.php';
$db = new Database();
$con = $db->con;
$postid = cleanse($_GET['id']) ?? '';
$posts = "select * from posts where id = '$postid'";
$result1 = mysqli_query($con, $posts);
$row1 = mysqli_fetch_assoc($result1);
$user_id = $row1['user_id'];
$category = $row1['category'];
$sql2 = "select profile.fname, user.type from profile,user where  user.id=profile.user_id and profile.user_id = '$user_id' ";
$result2 = mysqli_query($con, $sql2);
$row2 = mysqli_fetch_assoc($result2);
$user_type = $row2['type'];
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
  <link rel="stylesheet" href="../css/main.css">
  <title>Kam Nepal | Posts</title>
</head>
<body>
    <?php include '../index-nav.php' ?>
  <div class='modal' id="modal"></div>
  
  <div class="post-main">
  <div class="post-text">
      <h1 class="post-title"><?php echo $row1['title']; ?></h1>
      <div class="post-head">
          <span class="post-by">By<a href=""><?php echo $row2['fname']; ?></a></span>
          <span class="posted-on">
          Posted on <?php echo $row1['created_at']; ?>
          </span>
      </div>
     
      <div class="post-media">
        <img src="<?php echo $row1['media']; ?>" alt="post-image">
      </div>
      <div class="actual-post">
      <?php echo html_entity_decode(htmlspecialchars_decode($row1['body'])); ?>
      </div>
  </div>
  <div class="post-related">
    <h1 class="related-head">
      Related Posts
    </h1>
    <ul class="related-body">
      <?php
        $empsql = "select posts.title from posts,user where posts.user_id= user.id and user.type= 'Jobseeker' and posts.category = '$category' limit 10";
        if ($user_type === 'Employeer') {
            $empres = mysqli_query($con, $empsql);
            $i = 1;
            while ($row = mysqli_fetch_array($empres)) {
                echo ' 
          <li><span class="badge">0' . $i . '</span>
          <a href="">' . $row['title'] . '</a>
          </li>
          <hr>
        ';
                $i++;
            }
            $jobsql = "select posts.title from posts,user where posts.user_id= user.id and user.type= 'Employer' and posts.category = '$category' limit 10";
        } else if ($user_type === 'Jobseeker') {
            $i = 1;
            $jobres = mysqli_query($con, $empsql);
            while ($row = mysqli_fetch_array($jobres)) {
                echo ' 
        <li><span class="badge">0' . $i . '</span>
        <a href="">' . $row['title'] . '</a>
        </li>
        <hr>  
      ';
                $i++;
            }
        }
        ?>
    </ul>
  </div>
  
  </div>
  
  <?php include "../includes/footer.php" ?>
  <script src="/js/app.js"></script>
</body>
</html>