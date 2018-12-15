<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="stylesheet" href="../css/main.css" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous" />
  <title>Kam Nepal</title>
</head>

<body>
  <!-- navbar here -->
  <!-- <nav class="navbar">
    <div class="navbar--left">
      <img class="brand-logo" src="../img/logo/kamnepal.svg" alt="" width="96px" href="./index.php" />
      -- <a href='./index.php' class='brand-header links'>Kam Nepal</a> -->
  <!-- </div>
    <div class="navbar--right">
      <div class="navbar-links">
        <ul>
          <li>
            <a href=""><img style="width: 30px; height:30px;" src="../img/logo/search-solid.svg" alt="" /></a>
          </div>
          <li>
            <a href=""><img style="width: 30px; height:30px;" src="../img/logo/bell-regular.svg" alt="" /></a>
          </div>
          <li>
            <a href=""><img style="width: 30px; height:30px;" src="../img/logo/cog-solid.svg" alt="" /></a>
          </div>
          <li>
            <a href=""><img src="https://upload.wikimedia.org/wikipedia/commons/e/e0/Large_Scaled_Forest_Lizard.jpg"
                alt="a" style="width: 30px; height:30px;" /></a>
          </div>
        </ul>
      </div>
    </div>
  </nav> -->
  <!-- end navbar -->
  <div class="containerProfile">
    <div class="profileUpdate">
      <div class="headingpart">
        <h1 class='heading-primary'>Update Profile</h1>
        <!-- <span> update your personal information</span> -->
      </div>
      <hr>
      <div class="infopart">
        <form class="form1" action="">
              <div class="list2">
                  <img id="avatar" class="list2__image" src="../img/profile/profile.jpg" alt="Avatar" />
                <a href="3" id='edit-a'><img src="../img/logo/pencil-alt-solid.svg" alt="" srcset="" width='20px'></a>
                <!-- <input type="file" name="" id="edit-a"> -->
              </div>
              <div class="list1">
                <label class="label1" for="name">Name</label>
                <input class="input1" id="fname" type="text">
              </div>
              <div class="list1">
                <label class="label1" for="age">Age</label>
                <input id="age" class="input1" type="number" placeholder='18'>
              </div>
              <div class="list1">
                <label class="label1" for="gender">Gender</label>
                <div class="radios">
                  <div class="radios__item">
                    <input class="input2" id="male" type="radio" name="gender" value="male" />
                    <label class="label2" for="male">Male</label>
                  </div>
                  <div class="radios__item">
                    <input class="input2" id="female" type="radio" name="gender" value="female" />
                    <label class="label2" for="female">Female</label>
                  </div>
                  <div class="radios__item">
                    <input class="input2" id="others" type="radio" name="gender" value="other" />
                    <label class="label2" for="others">Others</label>
                  </div>
                </div>
              </div>
              <div class="list1">
                <label class="label1" for="address">Address</label>
                <textarea id="address" class="input1"></textarea>
              </div>
              <div class="list1">
                <label class="label1" for="employdetail">Employment details</label>
                <textarea id="employdetail" class="input1"></textarea>
              </div>
              <div class="list1">
                <label class="label1" for="bio">Bio</label>
                <textarea id="bio" class="input1"></textarea>
              </div>
  
              <div class="list1">
                <label class="label1" for="study">Study</label>
                <textarea id="study" class="input1"></textarea>
              </div>
              <div class="list1">
                <label class="label1" for="interest">
                  Interests
                </label>
                <textarea id="interest" class="input1" type="text"></textarea>
              </div>
              <div class="list1">
                <label class="label1" for="employstatus">
                  Current Employment Status</label>
                <div class="select-box">
                  <select name="categories" id="employstatus">
                    <option value="1">Employed</option>
                    <option value="2">Unemployed</option>
                  </select>
                </div>
              </div>
              <div class="list1">
                <label class="label1" for="dob">Date of Birth</label>
                <input id="dob" class="input1" type="date" />
              </div>
              <div class="list1">
                <label class="label1" for="contactinfo">Contact Info</label>
                <input id="contactinfo" class="input1" placeholder="Email" type="email" />
                <input id="contactinfo" class="input1" placeholder="Contact Number" type="tel" />
              </div>
  
              <div class="list1">
                <label class="label1" for="experiences">Experiences</label>
                <textarea id="experiences" class="input1"></textarea>
              </div>
              <div class="list1">
                <label class="label1" for="skills">Skills</label>
                <textarea id="skills" class="input1"></textarea>
              </div>
              <div class="list1">
                <label class="label1" for="password">Change Password</label>
                <input id="password" class="input1" type="password" placeholder="Current Password" />
                <input id="password"class="input1" type="password" placeholder="New Password" />
                <input id="password" class="input1" type="password" placeholder="Confirm New Password" />
              </div>
              
          <div class="down-button">
            <div>
              <button class="button-secondary" type="submit">Update Info
              </button>
              <!-- <button class="button-tertiary" type="submit" class="next">Create Resume
              </button> -->
            </div>
          </div>
        </form>
        <hr />
      </div>
    </div>
  </div>
</body>

</html>