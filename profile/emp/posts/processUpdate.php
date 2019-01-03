<?php
require('../../../auth/authenticate.php');
require('../../../database/db.php');
$db = new Database;
$con = $db->con;
$user_id = getColumn("SELECT id FROM user WHERE email='$email'", "id");
$fname = cleanse($_POST['fname']) ?? "";
$dob = cleanse($_POST['dob']) ?? "";
$address = cleanse($_POST['address']) ?? "";
$phone = cleanse($_POST['phone']) ?? "";
$bio = cleanse($_POST['bio']) ?? "";
$res = mysqli_query($con, "update profile set fname='$fname',dob='$dob',address='$address',phone='$phone',bio='$bio' where user_id='$user_id'");