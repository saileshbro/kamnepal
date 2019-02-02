<?php
// update all the fields
require('../../../auth/authenticate.php');
require('../../../database/db.php');
$db = new Database;
$con = $db->con;
$user_id = getColumn("SELECT id FROM user WHERE email='$email'", "id");
$fname = cleanse($_POST['fname']) ?? "";
$gender = cleanse($_POST['gender']) ?? "";
$dob = cleanse($_POST['dob']) ?? "";
$address = cleanse($_POST['address']) ?? "";
$phone = cleanse($_POST['phone']) ?? "";
$bio = cleanse($_POST['bio']) ?? "";
$employ_status = cleanse($_POST['employ_status']) ?? "";
$interest = cleanse($_POST['interest']) ?? "";

$res = mysqli_query($con, "update profile set fname='$fname',gender='$gender',dob='$dob',address='$address',phone='$phone',bio='$bio',employ_status='$employ_status',interest='$interest' where user_id='$user_id'");
foreach ($_POST as $key => $value) {
    if (substr($key, 0, 13) == "course-title-") {
        $courseTitle[$key] = cleanse($value);

    }
    if (substr($key, 0, 12) == "course-inst-") {
        $courseInst[$key] = cleanse($value);
    }
    if (substr($key, 0, 13) == "course-begin-") {
        $courseStart[$key] = cleanse($value);
    }
    if (substr($key, 0, 11) == "course-end-") {
        $courseEnd[$key] = cleanse($value);
    }
    if (substr($key, 0, 14) == "course-detail-") {
        $courseDetail[$key] = cleanse($value);
        $id = str_replace("course-detail-", "", $key);
        $x = $courseStart["course-begin-" . $id];
        $y = $courseTitle["course-title-" . $id];
        $z = $courseInst["course-inst-" . $id];
        $w = $courseEnd["course-end-" . $id];
        $s = $courseDetail["course-detail-" . $id];


        $n = mysqli_num_rows(mysqli_query($con, "select * from education where id='$id'"));
        if ($n > 0) {
            mysqli_query($con, "UPDATE education SET course_title='$y',inst_name='$z',start_year='$x',end_year='$w',details='$s' where id='$id'");
        } else {
            mysqli_query($con, "INSERT INTO education (user_id,course_title,inst_name,start_year,end_year,details) VALUES ('$user_id','$y','$z','$x','$w','$s')");
        }
    }
    if (substr($key, 0, 10) == "emp-title-") {
        $empTitle[$key] = cleanse($value);
    }
    if (substr($key, 0, 9) == "emp-comp-") {
        $empComp[$key] = cleanse($value);
    }
    if (substr($key, 0, 10) == "emp-begin-") {
        $empStart[$key] = cleanse($value);
    }
    if (substr($key, 0, 8) == "emp-end-") {
        $empEnd[$key] = cleanse($value);
    }
    if (substr($key, 0, 11) == "emp-detail-") {
        $empDetail[$key] = cleanse($value);
        $id = str_replace("emp-detail-", "", $key);
        $x = $empStart["emp-begin-" . $id];
        $y = $empTitle["emp-title-" . $id];
        $z = $empComp["emp-comp-" . $id];
        $w = $empEnd["emp-end-" . $id];
        $s = $empDetail["emp-detail-" . $id];
        $n = mysqli_num_rows(mysqli_query($con, "select * from experience where id='$id'"));
        if ($n > 0) {
            mysqli_query($con, "UPDATE experience SET emp_title='$y',emp_comp='$z',emp_start='$x',emp_end='$w',emp_details='$s' where id='$id'");
        } else {
            mysqli_query($con, "INSERT INTO experience (user_id,emp_title,emp_comp,emp_start,emp_end,emp_details) VALUES ('$user_id','$y','$z','$x','$w','$s')");
        }
    }
    if (substr($key, 0, 11) == "skill-type-") {
        $skillType[$key] = cleanse($value);
    }
    if (substr($key, 0, 11) == "skill-list-") {
        $skillList[$key] = cleanse($value);
        $id = str_replace("skill-list-", "", $key);
        $x = $skillType["skill-type-" . $id];
        $y = $skillList["skill-list-" . $id];
        $n = mysqli_num_rows(mysqli_query($con, "select * from skills where id='$id'"));
        if ($n > 0) {
            mysqli_query($con, "UPDATE skills SET skill_type='$x',skill_list='$y' where id='$id'");
        } else {
            mysqli_query($con, "INSERT INTO skills (user_id,skill_type,skill_list) VALUES ('$user_id','$x','$y')");
        }
    }
}
echo $user_id;