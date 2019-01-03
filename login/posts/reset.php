<?php

include '../../database/db.php';
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

    // send  mail with the reset link
    // kam.nepal/forgot.php?email=$email&fcode=$fcode
}
?>