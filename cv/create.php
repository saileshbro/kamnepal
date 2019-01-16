<?php
if (file_exists('../uploads/cv.png')) {
    unlink('../uploads/cv.png');
}
if (file_exists('../uploads/cv.jpg')) {
    unlink('../uploads/cv.jpg');
}
if (file_exists('../uploads/cv.jpeg')) {
    unlink('../uploads/cv.jpeg');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
        <link rel="stylesheet" href="../css/main.css" />
        <title>Kam Nepal | Create CV</title>
    </head>
    <body>
        <?php require('../includes/navbar-landing.php'); ?>
        <div class="navbar-center">
            <a href="/index.php"><img class='brand-logo' src="../img/logo/kamnepal.svg" alt="" width='90rem' height='90rem' href='./index.php'></a>
        </div>
        <div class="containerProfile">
          <div class="profileUpdate">
              <div class="headingpart">
                  <h1 class='heading-primary'>Create CV</h1>
              </div>
              <hr>
              <div class="infopart">
                <form class="form1" action="display.php" method='post'>
                  <div class="list2">
                    <img id="avatar" class="list2__image" src='../uploads/default.png' alt="Avatar"/>
                        <div id='edit-a'>
                            <i class="fas fa-pencil-alt fa-2x upload-button"></i>
                            <input class="file-upload" type="file" accept="image/*" style="display:none;" onchange="changeAvatar(this)"/>
                        </div>
                    </div>
                  <div class="list1">
                      <label class="label1" for="name">Name</label>
                      <input name='fname' class="input1" id="fname" type="text">
                  </div>
                  
                  <div class="list1">
                      <label class="label1" for="address">Address</label>
                      <textarea name='address' id="address" class="input1"></textarea>
                  </div>
                  <div class="list1">
                      <label class="label1" for="employdetail">About</label>
                      <textarea name='employ_details' id="employdetail" class="input1"></textarea>
                  </div>
                  <div class="list1">
                      <label class="label1" for="contactinfo">Contact Info</label>
                      <input id="contactinfo" name='email' class="input1" placeholder="Email" type="email"/>
                      <input id="contactinfo" name='phone' class="input1" placeholder="Contact Number" type="tel"/>
                  </div>
                  <div class="list1">
                      <label class="label1" for="name">Date of Birth</label>
                      <input name='dob' class="input1" id="dob" type="text" placeholder="Add your date of birth">
                  </div>
                  <div class="list1">
                      <label class="label1" for="interest">
                      Interests
                      </label>
                      <textarea name='interest' id="interest" class="input1" type="text" placeholder="Add one word interests seperated by comma."></textarea>
                  </div>                  
                  <div class="list1">
                      <label class="label1" for="study">Education</label>
                      <a href="javascript:;" id="addEducation" class='links'>Add Education</a>
                        <div id="education">
                        </div>
                  </div>
                  <div class="list1">
                  <label class="label1" for="study">Experience</label>
                      <a href="javascript:;" id="addExperience" class='links'>Add Experience</a>
                        <div id="experience">
                        </div>
                  </div>
                  <div class="list1">
                      <label class="label1" for="skills">Skills</label>
                      <a href="javascript:;" id="addSkill" class="links">Add Skills</a>
                      <div id="skill-set">
                        
                      </div>
                      
                  </div>
                  <div class="list1">
                    <div class="btn-down">
                        <button type="submit"class="button-primary" name="create"> create cv</button>
                    </div>
                  </div>
                  
                </form>
              </div>
          </div>
        </div>
        <?php require('../includes/footer.php') ?>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script src="../js/cv.js"></script>
        <script>
        function removeEduPressed(data) {
            let grandfather = data.parentElement; //education
            data.remove();
            let children = grandfather.children;
            for(let i= 0;i<children.length;i++){
                let inputs = children[i].children;
                inputs[0].attributes['name'].nodeValue="course-title-"+i;
                inputs[1].attributes['name'].nodeValue="course-inst-"+i;
                inputs[2].attributes['name'].nodeValue="course-begin-"+i;
                inputs[3].attributes['name'].nodeValue="course-end-"+i;
                inputs[4].attributes['name'].nodeValue="course-detail-"+i;
            }
        }

        function removeExpPressed(data) {
            let grandfather = data.parentElement;
            data.remove();
            let children = grandfather.children;
            for(let i= 0;i<children.length;i++){
                let inputs = children[i].childNodes;
                inputs[0].attributes['name'].nodeValue="emp-title-"+i;
                inputs[1].attributes['name'].nodeValue="emp-comp-"+i;
                inputs[2].attributes['name'].nodeValue="emp-begin-"+i;
                inputs[3].attributes['name'].nodeValue="emp-end-"+i;
                inputs[4].attributes['name'].nodeValue="emp-detail-"+i;
            }
        }

        function removeSkillPressed(data) {
            let grandfather = data.parentElement;
            data.remove();
            let children = grandfather.children;
            for(let i= 0;i<children.length;i++){
                let inputs = children[i].childNodes[0];
                inputs.childNodes[0].attributes['name'].nodeValue="skill-type-"+i;
                inputs.childNodes[1].attributes['name'].nodeValue="skill-list-"+i;
            }

        }
        </script>
            <script>
            function changeAvatar(data){
                var fileToUpload = $('.file-upload').prop('files')[0];
                var data = new FormData();
                data.append('image',fileToUpload);
                $.ajax({
                url:"upload.php",
                data: data,
                type: 'POST',
                contentType: false,
                processData: false,
                success: (data)=>{
                }
                });
            }
    </script>
    </body>
</html>