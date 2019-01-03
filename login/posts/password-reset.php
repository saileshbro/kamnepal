<?php
include("../../database/db.php");
$db = new Database();
$con = $db->con;

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

        echo '
        <script>
            location.href = "login.php";
        </script>
    ';
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
?>