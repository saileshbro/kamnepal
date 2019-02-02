<?php

require 'auth/authenticate.php';
$userId = getColumn("SELECT id FROM user WHERE email='$email'", "id"); //id of the currently logged in user
$profileImg = "./" . getColumn("SELECT profile_img FROM profile WHERE user_id='$userId'", "profile_img"); //profile img of the currently logged in user
$fullName = getColumn("SELECT fname FROM profile WHERE user_id='$userId'", "fname"); //name
$fullBio = getColumn("SELECT bio FROM profile WHERE user_id='$userId'", "bio"); //bio
$Type = getColumn("SELECT type FROM user WHERE email='$email'", "type"); //type
// bio limited to 100 chars
$disp = (strlen($fullBio) <= 95) ? $fullBio : substr($fullBio, 0, 100) . ' . . .'; //displaying a portion of bio 
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
                        if ($Type == "Employer") {//if employer go to employer profile
                            echo "<li><a href='/profile/emp/display.php?user_id=" . $userId . "'><i class='far fa-2x fa-user'></i><h3>My Profile</h3></a></li>";
                        } else {//else to jobseeker
                            echo "<li><a href='/profile/jsk/display.php?user_id=" . $userId . "'><i class='far fa-2x fa-user'></i><h3>My Profile</h3></a></li>";
                        }
                        ?>
                        <li><a href="javascript:;" onclick="gotoMessage()"><i class="far fa-2x fa-envelope"></i><h3>Messages</h3></a></li>
                    </ul>
                    <div class="drop-button"><button onclick="location.href='/login/logout.php';";class="links">Sign Out</button></div>
                </div>
            </div>
        </div>
        <!-- display notice here -->
        <div id="noticeDrop">
            <ul id ="notice-list">
            </ul>
        </div>
    </div>
</nav>
<script>
    // ******************** SEARCH ****************/
    // function to search from dashboard
    function searchDash(data) {
  if (data === "") { //hide list if input becomes empty
    $('.searches').hide();
  } else {
    $('.searches').show();
   // send ajax request to server script
    $.ajax({
      url: "/search.php",
      type: 'POST',
      data: {
        data: data
      },
      success: (data) => {
        //   receive response
        $('#search-list').html(data);
      }
    });
  }
}
//**********************GET CLEAR AND OPEN NOTICE***********/
// open specific notification
function openNotice(data){
    // send request to clearNotice.php with the notice id
    $.ajax({
        type:'POST',
        url:"/clearNotice.php",
        data:{
            type: 'single',
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
            // clear all notice
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
            // send user id of the notice reciever
            user_id:"<?= $userId ?>"
        },
        success:(data)=>{
            if(data==="null"){
                // if no notice returns
                $('#notice-list').html('<li class="post emptyNotice">No notifications</li>');
            }
            else{
                $('#notice-list').html(data);
            }
        }
    });
}
</script>