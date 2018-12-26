<nav  class="navbar dropped-navbar">
    <div class="navbar--left">
        <img class='brand-logo' src="img/logo/kamnepal.svg" alt="Kam Nepal" href='./index.php'>
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
                    <img src="img/profile/profile.jpg" alt="Profile-pic">
                    <div class="drop-text">
                        <div class="Prof-name">Sarayu Gautam</div>
                        <div class="Prof-bio">Lorem ipsum dolor sit amet consectetur Lorem ipsum dolor sit, amet consectetur adipisicing elit. Deserunt, doloribus!</div>
                    </div>
                </div>
                <div class="dropdown-profile-last">
                    <ul>
                        <li><a href=""><i class="far fa-2x fa-user"></i><h3>My Profile</h3></a></li>
                        <li><a href=""><i class="far fa-2x fa-envelope"></i><h3>Messages</h3></a></li>
                    </ul>
                    <div class="drop-button"><button class="links">Sign Out</button></div>
                </div>
            </div>
        </div>
    </div>
</nav>