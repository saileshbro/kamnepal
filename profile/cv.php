<?php 
// get information and displat CV
include '../database/db.php';
$db = new Database();
$con = $db->con;
$user_id = cleanse($_GET['user_id']);
$email = getColumn("select email from user where id='$user_id'", "email");
$sql = "select * from profile where user_id='$user_id'";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_array($res);
$fname = $row['fname'] ?? "";
$address = $row['address'] ?? "";
$about = $row['bio'] ?? "";
$phone = $row['phone'] ?? "";
$dob = $row['dob'] ?? "";
$interest = $row['interest'] ?? "";
$sql = "select * from education where user_id = '$user_id'";
$res = mysqli_query($con, $sql);
$profImg = "../" . getColumn("select profile_img from profile where user_id='$user_id'", "profile_img");
while ($row = mysqli_fetch_array($res)) {
    $courseTitle[] = $row['course_title'] ?? "";
    $courseInst[] = $row['inst_name'] ?? "";
    $courseStart[] = $row['start_year'] ?? "";
    $courseEnd[] = $row['end_year'] ?? "";
    $courseDetail[] = $row['details'] ?? "";
}
$sql = "select * from experience where user_id = '$user_id'";
$res = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($res)) {
    $empTitle[] = $row['emp_title'] ?? "";
    $empComp[] = $row['emp_comp'] ?? "";
    $empStart[] = $row['emp_start'] ?? "";
    $empEnd[] = $row['emp_end'] ?? "";
    $empDetail[] = $row['emp_details'] ?? "";
}
$sql = "select * from skills where user_id = '$user_id'";
$res = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($res)) {
    $skillType[] = $row['skill_type'] ?? "";
    $SkillList[] = $row['skill_list'] ?? "";

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="../css/main.css">
    <title>Display CV | Kam Nepal</title>
</head>
<body onload="window.print()">
   <div class="cv">
       <div id="page1">
       <header class="cv-head">
        <img src=<?php echo $profImg ?>  alt="CV Image" class="cv-head-img">
        <div class="cv-head-name">
            <h1><?php echo $fname ?></h1>
            <?php
            echo "<em>" . $interest . "</em>";
            ?>
            <p class="about"><?php echo $about ?></p>
        </div>
    </header>
    <main class="cv-body">
        <h1>personal details</h1>
        <hr>
        <div class="cv-details">
            <div class="left">
                <p>Phone</p>
                <p>E-mail</p>
                <p>Date of Birth</p>
                <p>Address</p>
            </div>
            <div class="right">
                <p><?php echo $phone ?></p>
                <p><?php echo $email ?></p>
                <p><?php echo $dob ?></p>
                <p><?php echo $address ?></p>
            </div>
        </div>
    </main>
    <section class="cv-education">
        <h1>education</h1>
        <hr>
        <?php 
        if (!isset($courseTitle)) {

        } else {
            for ($i = 0; $i < count($courseTitle); $i++) {
                echo "<div class='edu-content'>
                <div class='degree'>
                    <p>" . $courseTitle[$i] . "</p>
                    <p>" . $courseStart[$i] . " - " . $courseEnd[$i] . "</p>
                </div>
                <h3 class='name-ins'>" . $courseInst[$i] . "</h3>
                <p>" . $courseDetail[$i] . "</p></div>";
            }
        }
        ?>
    </section>
       </div>
    <section class="cv-experience">
        <h1>work experience</h1>
        <hr>
        <?php if (!isset($empTitle)) {

        } else {
            for ($i = 0; $i < count($empTitle); $i++) {
                echo "<div class='job-content'>
                    <div class='jobbox'>
                        <p class='job-name'>" . $empTitle[$i] . "</p>
                        <p>" . $empStart[$i] . " - " . $empEnd[$i] . "</p>
                    </div>
                    <p class='company'><span>" . $empComp[$i] . "</span> Full-time</p>
                    <p class='description'>" . $empDetail[$i] . "</p>
                </div>";
            }
        }
        ?>
        </section>
        <section class="cv-skills">
        <h1>skills</h1>
        <hr>
        <?php
        if (!isset($skillType)) {

        } else {
            for ($i = 0; $i < count($skillType); $i++) {
                echo "<div class='skill-div'><p class='skill-type'>" . $skillType[$i] . "</p> <p class='skill-list'>";
                echo " " . implode(",    ", explode(',', $SkillList[$i])) . " ";
                echo "</p></div>";
            }
        }
        ?>
    </section>
   </div>
</body>
</html>