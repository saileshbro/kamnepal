<?php

require 'auth/authenticate.php';
$userId = getColumn("SELECT id FROM user WHERE email='$email'", "id");
$profileImg = "./" . getColumn("SELECT profile_img FROM profile WHERE user_id='$userId'", "profile_img");
$fullName = getColumn("SELECT fname FROM profile WHERE user_id='$userId'", "fname");
$fullBio = getColumn("SELECT bio FROM profile WHERE user_id='$userId'", "bio");
$Type = getColumn("SELECT type FROM user WHERE email='$email'", "type");
// bio limited to 100 chars
$disp = (strlen($fullBio) <= 95) ? $fullBio : substr($fullBio, 0, 100) . ' . . .';
?>
<nav  class="navbar dropped-navbar">
    <div class="navbar--left" onclick="location.href = '../../dashboard.php';">
        <img class='brand-logo' src="/img/logo/kamnepal.svg" alt="Kam Nepal" href='javascript:;'>
        <h3>Kam<span>Nepal</span></h3>
    </div>
    <div class="navbar--center">
        <div class="dashboard-search">
            <div class="dash-search">
                <input type="text" oninput="searchDash(this.value);" class="dashboard-search-input" placeholder="Type here to search...">
                <i class="fas fa-search fa-3x"></i>
            </div>
            <div class="searches">
                <ul id="search-list">
                </ul>
            </div>
        </div>
    </div>
    <div class="navbar--right">
        <ul>
            <li><a  onclick="toggleNotice();"href="javascript:;"><i class="far notice fa-3x fa-bell"></i></a></li>
            <li><a href=""><i class="fas  fa-3x fa-cog"></i></a></li>
            <li><a onclick="toggleDropdownProf();" href="javascript:;"  id='prof-img'><img id="nav-pro-img" src=<?php echo $profileImg ?> alt=""></a></li>
        </ul>
        <div id="Prof-drop">
            <div class="dropdown-profile">
                <div class="dropdown-profile-mid">
                    <img src=<?php echo $profileImg ?> alt="Profile-pic">
                    <div class="drop-text">
                        <div class="Prof-name"><?php echo $fullName; ?></div>
                        <div class="Prof-bio"><?php echo $disp; ?></div>
                    </div>
                </div>
                <div class="dropdown-profile-last">
                    <ul>
                        <?php 
                        if ($Type == "Employer") {
                            echo "<li><a href='/profile/emp/display.php?user_id=" . $userId . "'><i class='far fa-2x fa-user'></i><h3>My Profile</h3></a></li>";
                        } else {
                            echo "<li><a href='/profile/jsk/display.php?user_id=" . $userId . "'><i class='far fa-2x fa-user'></i><h3>My Profile</h3></a></li>";
                        }
                        ?>
                        <li><a href="javascript:;" onclick="gotoMessage()"><i class="far fa-2x fa-envelope"></i><h3>Messages</h3></a></li>
                    </ul>
                    <div class="drop-button"><button onclick="location.href='/login/logout.php';";class="links">Sign Out</button></div>
                </div>
            </div>
        </div>
        <div id="noticeDrop">
            <ul id ="notice-list">
                <!-- <li id="chat"><a href="#"><i class="fas fa-envelope"></i><p>You have a message from.</p></a></li>
                <li id="post"><a href="#"><i class="fas fa-file-signature"></i><p>Someone viewed a post.</p></a></li>
                <li id="chat"><a href="#"><i class="fas fa-envelope"></i><p>You have a message from.</p></a></li>
                <li id="post"><a href="#"><i class="fas fa-file-signature"></i><p>Someone viewed a post.</p></a></li>
                <li id="chat"><a href="#"><i class="fas fa-envelope"></i><p>You have a message from.</p></a></li>
                <li id="post"><a href="#"><i class="fas fa-file-signature"></i><p>Someone viewed a post.</p></a></li> -->
                <?php
                $sql = "select * from notice where reciever_id='$userId' order by id desc";
                $res = mysqli_query($con, $sql);
                if (mysqli_num_rows($res) > 0) {
                    while ($row = mysqli_fetch_array($res)) {
                        $poster = getColumn("SELECT fname FROM profile where user_id=" . $row['sender_id'] . "", "fname");
                        ?>
                        <li id="post"><a href="posts/index.php?id=<?php echo $row['post_id']; ?>"><i class="fas fa-file-signature"></i><p><a href="profile/jsk/display.php?user_id="<?php echo $row['sender_id']; ?>><?php echo $poster; ?></a>viewed a post.</p></a></li>
                        <?php

                    }
                } else {
                    ?>
                    <li id="post" class="emptyNotice">No notifications</li>
                    <?php

                }
                ?>
            </ul>
        </div>
    </div>
</nav>
<script>
    function searchDash(data) {
  if (data === "") {
    $('.searches').hide();
  } else {
    $('.searches').show();
    $.ajax({
      url: "/search.php",
      type: 'POST',
      data: {
        data: data
      },
      success: (data) => {
        $('#search-list').html(data);
      }
    });
  }
}
</script>