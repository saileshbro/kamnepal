<?php
include '../database/db.php';
include '../auth/authenticate.php';
$db = new Database();
$con = $db->con;
$postid = cleanse($_GET['id']) ?? '';
$posts = "select * from posts where id = '$postid'";
$result1 = mysqli_query($con, $posts);
$viewerType = getColumn("select type from user where email='$email'", 'type');
$row1 = mysqli_fetch_assoc($result1);
$user_id = $row1['user_id'];
$publisherType = getColumn("select type from user where id='$user_id'", 'type');
$category = $row1['category'];
$sql2 = "select profile.fname, user.type from profile,user where  user.id=profile.user_id and profile.user_id = '$user_id' ";
$result2 = mysqli_query($con, $sql2);
$row2 = mysqli_fetch_assoc($result2);
$user_type = $row2['type'];

$str = getColumn("select interested from posts where id = '$postid'", "interested");
$str = substr($str, 0, strlen($str) - 1);
$userArr = explode(',', $str);
$userID = getColumn("select id from user where email='$email'", 'id');

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
  <?php
  if (!mysqli_num_rows($result1) > 0) {
    include '../index-nav.php';
    echo '<div class="post-main" style="height:578px">
    <div class="post-text">
        <h1 class="post-title">No Post available.</h1>
    </div>  
  </div>';
    include "../includes/footer.php";
    echo "<script src='/js/app.js'></script>";
    echo "<script>var src = '" . $profileImg . "';
    src = \"../..\"+src;
    $('#nav-pro-img').attr(\"src\",src);
    $('.dropdown-profile-mid img').attr(\"src\",src)</script>";
    die();
  }
  if ($row1['media'] !== "") {
    echo "<div class='modal' id='modal'>
            <div class='imageWrapper'>
              <a href='javascript:;' class='modal-title' onclick=\"$('.modal').fadeOut();\">&times;</a>
              <img class='postImage' src='../" . $row1['media'] . "'>
            </div>
          </div>";
  }
  include '../index-nav.php';
  ?>
  
  <div class="post-main">
  <div class="post-text">
      <div class="title-head">
        <h1 class="post-title"><?php echo $row1['title']; ?></h1>
        <?php if ($viewerType === 'Jobseeker' && $publisherType === 'Employer') {
          ?>
          <a href="javascript:;" onclick='interested();'><i class="fas fa-star"></i>Interested</a>
          <?php

        } else if ($viewerType === 'Employer' && $publisherType === 'Jobseeker') {
          ?>
          <a class="message" href="../messages/index.php?id=<?php echo $user_id; ?>"><i class="fas fa-envelope"></i>Mssage</a>
          <?php

        }
        ?>
      </div>
      <?php
      if (in_array($userID, $userArr)) {
        echo "<script>document.querySelector('i.fas.fa-star').classList.add('interest');</script>";
      } else {

      }
      ?>
      <div class="post-head">
          <span class="post-by">By<a href="../profile/jsk/display.php?user_id=<?php echo $user_id; ?>"><?php echo $row2['fname']; ?></a></span>
          <span class="posted-on">
          Posted on <?php echo $row1['created_at']; ?>
          </span>
      </div>
        <?php
        if ($row1['media'] !== "") {
          echo '<div onclick="showImage()" class="post-media"><img src="../' . $row1['media'] . '"></div>';
        }
        ?>
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
    $empsql = "select posts.title from posts,user where posts.user_id= user.id and user.type= 'Jobseeker' and posts.category = '$category'  and not posts.id = '$postid'limit 10";
    $jobsql = "select posts.title from posts,user where posts.user_id= user.id and user.type= 'Employer' and posts.category = '$category' and not posts.id = '$postid' limit 10";
    $empres = mysqli_query($con, $empsql);
    $jobres = mysqli_query($con, $jobsql);

    if ($viewerType === 'Employer') {
      if (mysqli_fetch_assoc($empres)) {
        $i = 1;
        while ($row = mysqli_fetch_assoc($empres)) {
          echo ' 
          <li><span class="badge">0' . $i . '</span>
          <a href="">' . $row['title'] . '</a>
          </li>
          <hr>
        ';
          $i++;
        }
      } else {
        echo '<p class="No"><span>!</span>No Related Posts Found</p>';
      }
    } else if ($viewerType === 'Jobseeker') {
      if (mysqli_fetch_assoc($jobres)) {
        $i = 1;
        while ($row = mysqli_fetch_assoc($jobres)) {
          echo ' 
          <li><span class="badge">0' . $i . '</span>
          <a href="">' . $row['title'] . '</a>
          </li>
          <hr>
        ';
          $i++;
        }
      } else {
        echo '<p class="No"><span>!</span>No Related Posts Found</p>';
      }
    }
    ?>
    </ul>
  </div>
  
  </div>
  
  <?php include "../includes/footer.php" ?>
  <script src="/js/app.js"></script>
  <script>
    function showImage(){
      $('.modal').fadeIn();
      $(document).mouseup(function (e) {
        var container = $(".imageWrapper");
        if (!container.is(e.target) && container.has(e.target).length === 0) {
          // container.fadeOut();
          $('.modal').fadeOut();
        }
      }); 
    }
    function gotoMessage(){
      location.href="../messages";
    }
    var src = "<?= $profileImg ?>";
  src = "../."+src;
  $('#nav-pro-img').attr("src",src);
  $('.dropdown-profile-mid img').attr("src",src);
  function interested(){
    $.ajax({
      url:"posts/interest.php",
      type: 'POST',
      data: {
        post_id : "<?= $postid ?>"
      },
      success:(data)=>{
        if(data==='add'){
          $('i.fas.fa-star').addClass('interest');
        }else{
          $('i.fas.fa-star').removeClass('interest');
        }
      }
    });
    
  }
  </script>
</body>
</html>