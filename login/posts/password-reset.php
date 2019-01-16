<?php
include("../../database/db.php");
$db = new Database();
$con = $db->con;
if (isset($_POST['password3']) && isset($_POST['user_id'])) {
    $user_id = cleanse($_POST['user_id']) ?? "";
    $email = getColumn("select email from user where id='$user_id'", 'email');
    $dbpass = getColumn("select password from user where id='$user_id'", 'password');
    $pass1 = cleanse($_POST['password']) ?? "";
    $pass2 = cleanse($_POST['password2']) ?? "";
    $pass3 = cleanse($_POST['password3']) ?? "";
    try {
        if ($dbpass !== md5($pass1 . $email)) {
            throw new Exception("Current password is invalid!");
        }
        if ($pass2 !== $pass3) {
            throw new Exception("Two passwords didn't match.");
        }
        if (strlen($pass2) < 6) {
            throw new Exception("Password should be six characters long.");
        }
        $pass2 = md5($pass2 . $email);
        $sql1 = "UPDATE user set password='$pass2' WHERE email='$email'";
        $res1 = mysqli_query($con, $sql1);
        echo "Password changed sucessfully.";

    } catch (Exception $e) {
        echo $e->getMessage();
    }
} else {
    $email = cleanse($_POST['email']) ?? "";
    $fcode = cleanse($_POST['fcode']) ?? "";
    $sql = "SELECT id FROM user WHERE email='$email' AND fcode='$fcode'";
    $res = mysqli_query($con, $sql);
    $num = mysqli_num_rows($res);
    if ($num > 0) {
        $password = cleanse($_POST['password']) ?? "";
        $password2 = cleanse($_POST['password2']) ?? "";
        try {

            if (strlen($password) < 6) {
                throw new Exception("Password should be six characters long.");
            }

            if ($password !== $password2) {
                throw new Exception("Confirmed password did not match.");
            }

            $password = md5($password . $email);
            $sql1 = "UPDATE user set password='$password' WHERE email='$email'";
            $res1 = mysqli_query($con, $sql1);
            $str = "";
            mysqli_query($con, "update user set fcode='$str' where email='$email'");
            echo '
        <script>
            location.href = "login.php";
        </script>
    ';
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
?>