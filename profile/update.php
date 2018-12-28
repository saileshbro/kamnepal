<?php
  require('../auth/authenticate.php');
  require('../database/db.php');
  $db = new Database;
  $con = $db->con;
  $user_id = getColumn("SELECT id FROM user WHERE email='$email'", "id");
  $educationCount = getColumn("SELECT * FROM education WHERE ID = (SELECT MAX(ID) FROM education)","id");
  $experienceCount = getColumn("SELECT * FROM experience WHERE ID = (SELECT MAX(ID) FROM experience)","id");
  $skillCount = getColumn("SELECT * FROM skills WHERE ID = (SELECT MAX(ID) FROM skills)","id");
  if (isset($_POST['update'])){
    $fname = cleanse($_POST['fname'])??'';
    $gender = cleanse($_POST['gender'])??'';
    $dob = cleanse($_POST['dob'])??'';
    $address = cleanse($_POST['address'])??'';
    $phone = cleanse($_POST['phone'])??'';
    $employ_status = cleanse($_POST['employ_status'])??'';
    $interest = cleanse($_POST['interest'])??'';
    $bio = cleanse($_POST['bio'])??'';
    $sql = "UPDATE profile SET fname='$fname',gender='$gender',dob='$dob',address='$address',phone='$phone',employ_status='$employ_status',interest='$interest',bio='$bio' WHERE user_id='$user_id'";
    mysqli_query($con,$sql);

    $courseTitle = [];
    $courseInst = [];
    $courseStart = [];
    $courseEnd = [];
    $courseDetail = [];
    $empTitle = [];
    $empComp = [];
    $empStart = [];
    $empEnd = [];
    $empDetail = [];
    $skillType= [];
    $skillList = array(array());
    while(isset($_POST['course-detail-'.$i])){
      $courseDetail[]=cleanse($_POST['course-detail-'.$i])??"";
      $courseTitle[]=cleanse($_POST['course-title-'.$i])??"";
      $courseEnd[]=cleanse($_POST['course-end-'.$i])??"";
      $courseInst[]=cleanse($_POST['course-inst-'.$i])??"";
      $courseStart[]=cleanse($_POST['course-begin-'.$i])??"";
      $i++;
  }
  // for($i=0;$i<count($courseTitle);$i++){
  //   $sql = "select * from education where id='$i'";
  //   $res = mysqli_query($con,$sql);
  //   if(mysqli_num_rows($res)>0){
  //     $sql = "update education set user_id='$user_id',course_title='$courseTitle[$i],inst_name='$courseInst[$i]',start_year='$courseStart[$i]',end_year='$courseEnd[$i]',details='$courseDetail[$i]' where id='$i+1'";
  //     mysqli_query($con,$sql);
  //   }
  //   else{
  //     $sql = "insert into education (id,user_id,course_title,inst_name,start_year,end_year,details) values (null,'$user_id','$courseTitle[$i]','$courseInst[$i]','$courseStart[$i]','$courseEnd[$i]','$courseDetail[$i]')";
  //     mysqli_query($con,$sql);
  //   }
  // }
  while(isset($_POST['emp-title-'.$j])){
      $empDetail[]=cleanse($_POST['emp-detail-'.$j])??"";
      $empComp[]=cleanse($_POST['emp-comp-'.$j])??"";
      $empEnd[]=cleanse($_POST['emp-end-'.$j])??"";
      $empStart[]=cleanse($_POST['emp-begin-'.$j])??"";
      $empTitle[]=cleanse($_POST['emp-title-'.$j])??"";
      $j++;
  }
  
  while(isset($_POST['skill-type-'.$k])){
      $skillType[]=cleanse($_POST['skill-type-'.$k])??"";
      $skillList[$k]=explode(',',cleanse($_POST['skill-list-'.$k]))??"";
      $k++;
  }
  }
  $sql = "select * from profile where user_id='$user_id'";
  $res = mysqli_query($con,$sql);
  while($row=mysqli_fetch_array($res)){
    $fname = $row['fname'];
    $gender = $row['gender'];
    $dob=$row['dob'];
    $address=$row['address'];
    $phone=$row['phone'];
    // $profile_img=$row['profile_img'];
    $employ_status=$row['employ_status'];
    $interest=$row['interest'];
    $bio=$row['bio'];
    $updated_at = $row['updated_at'];
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="stylesheet" href="../css/main.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous" />
  <title>Kam Nepal</title>
</head>
<body>
  <div class="containerProfile">
    <div class="profileUpdate">
      <div class="headingpart">
        <h1 class='heading-primary'>Update Profile</h1>
        <!-- <span> update your personal information</span> -->
      </div>
      <hr>
      <div class="infopart">
        <form class="form1" action="" method='post'>
        <div class="list2">
              <img id="avatar" class="list2__image" src="../img/profile/profile.jpg" alt="Avatar" />
          </div>
          <div class="list1">
            <label class="label1" for="name">Name</label>
            <input name='fname' class="input1" id="fname" type="text" value="<?php echo $fname?>">
          </div>
          <div class="list1">
            <label class="label1" for="gender">Gender</label>
            <div class="radios">
            <?php
              if($gender==='male'||$gender==='Male'){
                echo '   <div class="radios__item">
                <input name="gender" class="input2" id="male" type="radio" name="gender" value="Male" checked />
                <label class="label2" for="male">Male</label>
              </div>
              <div class="radios__item">
                <input name="gender" class="input2" id="female" type="radio" name="gender" value="Female" />
                <label class="label2" for="female">Female</label>
              </div>
              <div class="radios__item">
                <input name="gender" class="input2" id="others" type="radio" name="gender" value="other" />
                <label class="label2" for="others">Others</label>';
              }
              else if($gender==='female'||$gender==='Female'){
                echo '   <div class="radios__item">
                <input name="gender" class="input2" id="male" type="radio" name="gender" value="Male" />
                <label class="label2" for="male">Male</label>
              </div>
              <div class="radios__item">
                <input name="gender" class="input2" id="female" type="radio" name="gender" value="Female" checked />
                <label class="label2" for="female">Female</label>
              </div>
              <div class="radios__item">
                <input name="gender" class="input2" id="others" type="radio" name="gender" value="other" />
                <label class="label2" for="others">Others</label>';
              }
              else if($gender==='others'||$gender==='Others'){
                echo '   <div class="radios__item">
                <input name="gender" class="input2" id="male" type="radio" name="gender" value="Male" />
                <label class="label2" for="male">Male</label>
              </div>
              <div class="radios__item">
                <input name="gender" class="input2" id="female" type="radio" name="gender" value="Female"  />
                <label class="label2" for="female">Female</label>
              </div>
              <div class="radios__item">
                <input name="gender" class="input2" id="others" type="radio" name="gender" value="other" checked/>
                <label class="label2" for="others">Others</label>';
              }
              else{
                echo '   <div class="radios__item">
                <input name="gender" class="input2" id="male" type="radio" name="gender" value="Male" />
                <label class="label2" for="male">Male</label>
              </div>
              <div class="radios__item">
                <input name="gender" class="input2" id="female" type="radio" name="gender" value="Female"  />
                <label class="label2" for="female">Female</label>
              </div>
              <div class="radios__item">
                <input name="gender" class="input2" id="others" type="radio" name="gender" value="other"/>
                <label class="label2" for="others">Others</label>';
              }
            ?>
              </div>
            </div>
          </div>
          <div class="list1">
            <label class="label1" for="dob">Date of Birth</label>
            <input id="dob" name='dob' class="input1 dob" type="text" value='<?php echo $dob;?>'/>
          </div>
          <div class="list1">
            <label class="label1" for="address">Address</label>
            <textarea name='address' id="address" class="input1"><?php echo($address)?></textarea>
          </div>
          <div class="list1">
            <label class="label1" for="contactinfo">Contact Info</label>
            <input id="contactinfo" name='phone' class="input1" placeholder="Contact Number" type="tel" value='<?php echo $phone;?>'/>
          </div>
          <div class="list1">
            <label class="label1" for="bio">Bio</label>
            <textarea name='bio' id="bio" class="input1"><?php echo($bio)?></textarea>
          </div>
          <div class="list1">
            <label class="label1" for="employstatus">
              Current Employment Status</label>
            <div class="select-box">
              <select name="employ_status" id="employstatus">
              <?php
              if($employ_status==='Employed'){
              ?>
                <option value="Employed" >Employed</option>
                <option value="Unemployed" >Unemployed</option>
                <?php
              } else {
                ?>
                <option value="Unemployed" >Unemployed</option>
                <option value="Employed" >Employed</option>
                <?php
                }
              ?>
              </select>
            </div>
          </div>
          <div class="list1">
            <label class="label1" for="interest">
              Interests
            </label>
            <textarea name='interest' id="interest" class="input1" type="text"><?php echo($interest)?></textarea>
          </div>
          <div class="list1">
            <label class="label1" for="study">Education</label>
            <a href="javascript:;" id="addEducation" class='links'>Add Education</a>
            <div id="education">
                <?php
                $sql = "select * from education where user_id = '$user_id'";
                $res=mysqli_query($con,$sql);
                while($row=mysqli_fetch_assoc($res)){
                  echo "<div class='cvform edu-".$row['id']."'>
                    <input type='text' name='course-title-".$row['id']."' placeholder='Your course name' value=".$row['course_title']." >
                    <input type='text' name='course-inst-".$row['id']."' placeholder='Your Institution&apos;s name' value=".$row['inst_name']." >
                    <input type='text' name='course-begin-".$row['id']."' placeholder='Course start year' value=".$row['start_year']." >
                    <input type='text' name='course-end-".$row['id']."' placeholder='Course ended. Blank for present' value=".$row['end_year']." >
                    <textarea name='course-detail-".$row['id']."' id='' cols='30' rows='10' placeholder='Add your course Details'>".$row['details']."</textarea>
                    <a href='javascript:;'class='links remedu' id=edu-".$row['id']." >Remove</a>
                  </div>";
                }
                ?>
            </div>
          </div>
          <div class="list1">
            <label class="label1" for="study">Experience</label>
              <a href="javascript:;" id="addExperience" class='links'>Add Experience</a>
              <div id="experience">
                <?php
                $sql = "select * from experience where user_id = '$user_id'";
                $res = mysqli_query($con,$sql);
                while($row=mysqli_fetch_array($res)){
                  echo "<div class='cvform exp-".$row['id']."'>
                  <input type='text' name='emp-title-".$row['id']."' placeholder='Job title | Designation' value=".$row['emp_title']." ><
                  input type='text' name='emp-comp-".$row['id']."' placeholder='Add the company&apos;s name.' value=".$row['emp_comp']." >
                  <input type='text' name='emp-begin-".$row['id']."' placeholder='Start year' value=".$row['emp_start']." >
                  <input type='text' name='emp-end-".$row['id']."' placeholder='End Year | Blank for Current' value=".$row['emp_end']." >
                  <textarea name='emp-detail-".$row['id']."' id='' cols='30' rows='10' placeholder='Explain your role'>".$row['emp_details']."</textarea>
                  <a href='javascript:;' onclick='removeExpPressed();' class='links remexp' id=emp-".$row['id']."' >Remove</a></div>";
                }
                ?>
              </div>
          </div>
          <div class="list1">
              <label class="label1" for="skills">Skills</label>
              <a href="javascript:;" id="addSkill" class="links">Add Skills</a>
              <div id="skill-set">
                <?php
                  $sql = "select * from skills where user_id ='$user_id'";
                  $res = mysqli_query($con,$sql);
                  while($row=mysqli_fetch_array($res)){
                    echo "<div class='skillinp skills-".$row['id']."'>
                      <div class='inpgrp'>
                        <input id='skills' name='skill-type-".$row['id']."' value=".$row['skill_type']." class='input1' placeholder='Add skill type. Eg. Language'>
                        <input id='skills' name='skill-list-".$row['id']."' value=".$row['skill_list']." class='input1' placeholder='Add skills. Eg. English, French, Spanish'>
                      </div>
                      <a href='javascript:;' onclick='removeSkillPressed();' class='links remskill' id=skill-".$row['id']."' >Remove</a>
                      </div>
                    </div>";
                  }
                ?>
              </div>
          </div>
          <div class="down-button">
            <div>
              <button class="button-secondary" type="submit" name='update'>Update Info
              </button>
            </div>
          </div>
        </form>
        <hr/>
      </div>
    </div>
  </div>
  <?php require('../includes/footer.php')?>
  <script>
    var val1 = "<?= $educationCount ?>";
    var val2 = "<?= $experienceCount ?>";
    var val3 = "<?= $skillCount ?>";
  </script>
  <script>
    // function removeEduPressed() {
    // let val = val1 - 1;
    // let str = ".remedu" + val;
    // let str2 = ".edu-" + val;
    // $(str2).remove();
    // val1--;
    // var str= event.target.id;
    // alert(str);
    //   var eduId = str.slice(4,str.length);
    //   $.ajax({
    //     type: "POST",
    //     url : "posts/process.php",
    //     data:{
    //       eduId : eduId
    //     },
    //     success:(data)=>{
    //       alert(data);
    //     }
    //   }); 
    // }
    // $(".remedu").click(function(event) {
    //     var str= event.target.id;
    //     var eduId = str.slice(4,str.length);
    //     $.ajax({
    //       type: "POST",
    //       url : "posts/process.php",
    //       data:{
    //         eduId : eduId
    //       },
    //       success:(data)=>{
    //         alert(data);
    //       }
    //     });       
    // });


  </script>
  <script type="text/javascript" src="../js/app.js"></script>
</body>
</html>