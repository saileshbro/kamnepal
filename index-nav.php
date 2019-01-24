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
            <li><a  onclick="toggleNotice();getNotice();"href="javascript:;"><i class="far fa-3x fa-bell"></i></a></li>
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
//*****************bhabin************** */
// open specific notification
function openNotice(data){
    $.ajax({
        type:'POST',
        url:"/clearNotice.php",
        data:{
            type: 'post',
            notice_id : data
        },
        success: (data)=>{
            $("#"+data).addClass('seenNotice');
            getNotice();
        }
    });
}
// clear all notice******************
function clearNotice(){
    $.ajax({
        type:'POST',
        url:"/clearNotice.php",
        data:{
            type: 'all',
            user_id : "<?= $userId ?>"
        },
        success: (data)=>{
            for(let i=1;i<$('#notice-list').children().length;i++){
                $('#notice-list').children()[i].hide("slide", { direction: "left" }, 1000);
            }
            getNotice();
        }
    });
}
// get notice from database********************
function getNotice(){
    $.ajax({
        url:"/getNotice.php",
        type:'POST',
        data:{
            user_id:"<?= $userId ?>"
        },
        success:(data)=>{
            if(data==="null"){
                $('#notice-list').html('<li class="post emptyNotice">No notifications</li>');
            }
            else{
                $('#notice-list').html(data);
            }
        }
    });
}
</script>