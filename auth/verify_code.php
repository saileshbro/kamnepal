<?php
    require_once('../database/db.php');
    $db = new Database;
    $con = $db->con;

    $email = cleanse($_GET['email'])??'';
    $vcode = cleanse($_GET['vcode'])??'';

    $num = mysqli_num_rows(mysqli_query($con, "SELECT id FROM user WHERE email='$email' AND vcode='$vcode'"));

    if ($num > 0){
        //Success
        echo "Email validated successfully.";
        mysqli_query($con,"UPDATE user SET v_status='yes' WHERE email='$email' AND vcode='$vcode'");
    } else {
        //Not match
        echo "Invalid combination.";
    }
?>