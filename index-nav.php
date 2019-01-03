<?php

require 'auth/authenticate.php';
$userId = getColumn("SELECT id FROM user WHERE email='$email'", "id");
$fullName = getColumn("SELECT fname FROM profile WHERE user_id='$userId'", "fname");
$fullBio = getColumn("SELECT bio FROM profile WHERE user_id='$userId'", "bio");
$Type = getColumn("SELECT type FROM user WHERE email='$email'", "type");
// bio limited to 100 chars
$disp = (strlen($fullBio) <= 95) ? $fullBio : substr($fullBio, 0, 100) . ' . . .';
?>
<nav  class="navbar dropped-navbar">
    <div class="navbar--left">
        <img class='brand-logo' src="/img/logo/kamnepal.svg" alt="Kam Nepal" href='javascript:;'>
        <h3>Kam<span>Nepal</span></h3>
    </div>
    <div class="navbar--center">
        <div class="dashboard-search">
            <input type="text" class="dashboard-search-input" placeholder="Type here to search...">
            <a href=""><i class="fas fa-search fa-3x"></i></a>
        </div>
    </div>
    <div class="navbar--right">
        <ul>
            <li><a href=""><i class="far  fa-3x fa-bell"></i></a></li>
            <li><a href=""><i class="fas  fa-3x fa-cog"></i></a></li>
            <li><a onclick="toggleDropdownProf();" href="javascript:;"  id='prof-img'><img id="nav-pro-img" src="https://upload.wikimedia.org/wikipedia/commons/e/e0/Large_Scaled_Forest_Lizard.jpg" alt=""></a></li>
        </ul>
        <div id="Prof-drop">
            <div class="dropdown-profile">
                <div class="dropdown-profile-mid">
                    <img src="/img/profile/profile.jpg" alt="Profile-pic">
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
                        <li><a href=""><i class="far fa-2x fa-envelope"></i><h3>Messages</h3></a></li>
                    </ul>
                    <div class="drop-button"><button onclick="location.href='/login/logout.php';";class="links">Sign Out</button></div>
                </div>
            </div>
        </div>
    </div>
</nav>