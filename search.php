<?php
require('database/db.php');
$db = new Database();
$con = $db->con;
$query = cleanse($_POST['data']) ?? '';
$list1 = "select profile.fname, profile.id, user.type from profile,user where profile.user_id=user.id and profile.fname like '%$query%'";
$prolist = mysqli_query($con, $list1);
$list2 = "select id,title from posts where title like '%$query%'";
$polist = mysqli_query($con, $list2);
if (!(mysqli_num_rows($polist) || mysqli_num_rows($prolist))) {
    echo '<div class="each-list" style=" border:none;">
  <li style="color:red;"> <i class="fas fa-times"></i>Nothing found</li>
  </div>';
} else {
    while ($row = mysqli_fetch_assoc($prolist)) {
        if ($row['type'] === 'Jobseeker') {
            echo '
     <div class="each-list">
     <li> <i style="color:#ff1073" class="fas fa-user"></i><a href="profile/jsk/display.php?user_id=' . $row['id'] . '">' . $row['fname'] . '</a></li>
     </div>
     ';
        } else if ($row['type'] === 'Employer') {
            echo '
     <div class="each-list">
     
     <li> <i style="color:green" class="far fa-building"></i><a href="profile/emp/display.php?user_id=' . $row['id'] . '">' . $row['fname'] . '</a></li>
     </div>
     ';
        }

    }
    while ($row = mysqli_fetch_assoc($polist)) {
        echo '
      <div class="each-list">
      <li><i style="color: black" class="fas fa-file-signature"></i><a href="posts/index.php?id=' . $row['id'] . '">' . $row['title'] . '</a></li>
      </div>
      ';
    }
}

?>