<?php
$i=0;$j=0;$k=0;
$fname = $_POST['fname']??"";
$address = $_POST['address']??"";
$about = $_POST['employ_details']??"";
$email = $_POST['email']??"";
$phone = $_POST['phone']??"";
$dob = $_POST['dob']??"";
$interest = $_POST['interest']??"";
$interest = explode(',',$interest);
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
    $courseDetail[]=$_POST['course-detail-'.$i]??"";
    $courseTitle[]=$_POST['course-title-'.$i]??"";
    $courseEnd[]=$_POST['course-end-'.$i]??"";
    $courseInst[]=$_POST['course-inst-'.$i]??"";
    $courseStart[]=$_POST['course-begin-'.$i]??"";
    $i++;
}

while(isset($_POST['emp-title-'.$j])){
    $empDetail[]=$_POST['emp-detail-'.$j]??"";
    $empComp[]=$_POST['emp-comp-'.$j]??"";
    $empEnd[]=$_POST['emp-end-'.$j]??"";
    $empStart[]=$_POST['emp-begin-'.$j]??"";
    $empTitle[]=$_POST['emp-title-'.$j]??"";
    $j++;
}

while(isset($_POST['skill-type-'.$k])){
    $skillType[]=$_POST['skill-type-'.$k]??"";
    $skillList[$k]=explode(',',$_POST['skill-list-'.$k])??"";
    $k++;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/main.css">
    <title>Display CV | Kam Nepal</title>
</head>
<body onload="window.print()">
   <div class="cv">
       <div id="page1">
       <header class="cv-head">
        <img src="../img/profile/profile.jpg"  alt="CV Image" class="cv-head-img">
        <div class="cv-head-name">
            <h1><?php echo $fname?></h1>
            <?php for($i=0;$i<count($interest);$i++){
                echo"<em>".$interest[$i]."</em>";
            }
            ?>
            <p class="about"><?php echo $about?></p>
        </div>
    </header>
    <main class="cv-body">
        <h1>personal details</h1>
        <hr>
        <div class="cv-details">
            <div class="left">
                <p>Date of Birth</p>
                <p>Address</p>
                <p>Phone</p>
                <p>E-mail</p>
            </div>
            <div class="right">
                <p><?php echo $dob?></p>
                <p><?php echo $address?></p>
                <p><?php echo $phone?></p>
                <p><?php echo $email?></p>
            </div>
        </div>
    </main>
    <section class="cv-education">
        <h1>education</h1>
        <hr>
        <?php for($i=0;$i<count($courseTitle);$i++){
        echo "<div class='edu-content'>
            <div class='degree'>
                <p>".$courseTitle[$i]."</p>
                <p>". $courseStart[$i]." - ".$courseEnd[$i]."</p>
            </div>
            <h3 class='name-ins'>".$courseInst[$i]."</h3>
            <p>".$courseDetail[$i]."</p></div>";
        }
            ?>
        
    </section>
       </div>
    <section class="cv-experience">
        <h1>work experience</h1>
        <hr>
        <?php for($i=0;$i<count($empTitle);$i++){
        echo "<div class='job-content'>
                <div class='job'>
                    <p class='job-name'>".$empTitle[$i]."</p>
                    <p>".$empStart[$i]." - ". $empEnd[$i]."</p>
                </div>
                <p class='company'><span>".$empComp[$i]."</span> Full-time</p>
                <p class='description'>".$empDetail[$i]."</p>
            </div>";
        }?>
        </section>
        <section class="cv-skills">
        <h1>skills</h1>
        <hr>
        <?php
        for($i=0;$i<count($skillType);$i++){
            echo"<div class='skill-div'><p class='skill-type'>".$skillType[$i]."</p> <p class='skill-list'>";
            for($j=0;$j<count($skillList[$i]);$j++){
                echo " ".$skillList[$i][$j]." ";
            }
            echo"</p></div>";
        }
        ?>
    </section>
   </div>
</body>
</html>