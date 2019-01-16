<?php

include '../../database/db.php';
include_once '../../phpmailer/Mailer.php';
$db = new Database();
$con = $db->con;
$email = cleanse($_POST['email']) ?? '';
$sql = "SELECT id FROM user WHERE email ='$email'";
$res = mysqli_query($con, $sql);
$num = mysqli_num_rows($res);


if ($num > 0) {
    $fcode = substr(str_shuffle(md5(microtime())), 0, 7);
    $sql1 = "UPDATE user set fcode='$fcode' WHERE email='$email'";
    $res1 = mysqli_query($con, $sql1);
    $link = "kam.nepal/login/forgot.php?email=$email&fcode=$fcode";
    $link = "<a href='$link'>" . $link . "</a>";
    $mailer = new Mailer();
    $mailer->sendMail($email, "Reset your Kam Nepal password", $link);
}
?>