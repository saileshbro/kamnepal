<?php
require('../../auth/authenticate.php');
require('../../database/db.php');
$db = new Database;
$con = $db->con;
$user_id = getColumn("SELECT id FROM user WHERE email='$email'", "id");

$fname = cleanse($_POST['fname']) ?? "";
$gender = cleanse($_POST['gender']) ?? "";
$dob = cleanse($_POST['dob']) ?? "";
$address = cleanse($_POST['address']) ?? "";
$phone = cleanse($_POST['phone']) ?? "";
$bio = cleanse($_POST['bio']) ?? "";
$employ_statue = cleanse($_POST['employ_status']) ?? "";
$interest = cleanse($_POST['interest']) ?? "";
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
    }
}
foreach ($_POST as $key => $value) {
    // if (substr($key,))
}