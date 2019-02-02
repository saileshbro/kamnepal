<?php
require('database/db.php');
$db = new Database();
$con = $db->con;
// if query length is less than 3 chars, die
$query = cleanse($_POST['data']) ?? '';
if (strlen($query) < 3) {
    die();
}
// search name from profile and display as result
$list1 = "select profile.fname, profile.id, user.type from profile,user where profile.user_id=user.id and profile.fname like '%$query%' order by fname asc";
$prolist = mysqli_query($con, $list1);//profile list
// search from posts and display as result
$list2 = "select id,title from posts where title like '%$query%'";
$polist = mysqli_query($con, $list2);//post list
if (!(mysqli_num_rows($polist) || mysqli_num_rows($prolist))) {
    // if no results appear
    echo '<div class="each-list" style=" border:none;">
  <li style="color:red;"> <i class="fas fa-times"></i>Nothing found</li>
  </div>';
} else {
    while ($row = mysqli_fetch_assoc($prolist)) {
        // display profiles first as result
        if ($row['type'] === 'Jobseeker') {
            echo '
     <div class="each-list">
     <li> <i style="color:#ff1073" class="fas fa-user"></i><a class="name" href="/profile/jsk/display.php?user_id=' . $row['id'] . '">' . $row['fname'] . '</a></li>
     </div>
     ';
        } else if ($row['type'] === 'Employer') {
            echo '
     <div class="each-list">
     
     <li> <i style="color:green" class="far fa-building"></i><a class="name" href="/profile/emp/display.php?user_id=' . $row['id'] . '">' . $row['fname'] . '</a></li>
     </div>
     ';
        }

    }
    while ($row = mysqli_fetch_assoc($polist)) {
        // display posts first as result
        echo '
      <div class="each-list">
      <li><i style="color: black" class="fas fa-file-signature"></i><a class="name" href="/posts/index.php?id=' . $row['id'] . '">' . $row['title'] . '</a></li>
      </div>
      ';
    }
}
?>