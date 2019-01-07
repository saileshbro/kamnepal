<?php
include("../../database/db.php");
include_once "../../phpmailer/Mailer.php";
$db = new Database();
$con = $db->con;

$fname = cleanse($_POST['fname']) ?? "";
$email = cleanse($_POST['email']) ?? "";
$password = cleanse($_POST['password']) ?? "";
$password2 = cleanse($_POST['password2']) ?? "";
$category = cleanse($_POST['category']) ?? "";
$phone = cleanse($_POST['phone']) ?? "";
$type = cleanse($_POST['type']) ?? "Jobseeker";

try {
    if (strlen($fname) < 5 || strpos($fname, " ") === false) {
        throw new Exception("Enter your proper full name.");
    }

    if (preg_match('/@gmail.com|@yahoo.com|@live.com|@hotmail.com/', $email) == 0 && $type === "Jobseeker") {
        throw new Exception("We do not support email from the domain you've provided.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) && $type === "Employer") {
        throw new Exception("Invalid Email.");
    }

    if (strlen($password) < 6) {
        throw new Exception("Password should be six characters long.");
    }

    if ($password !== $password2) {
        throw new Exception("Confirmed password did not match.");
    }

    if (strlen($phone) < 8) {
        throw new Exception("Enter a proper phone number.");
    }

    $num = mysqli_num_rows(mysqli_query($con, "SELECT id FROM user WHERE email='$email'"));

    if ($num > 0) {
        throw new Exception("Email already associated with another account.");
    }

    $vcode = substr(str_shuffle(md5(microtime())), 0, 6);
    $password = md5($password . $email);

    mysqli_query($con, "INSERT INTO user (email, password, vcode, type) VALUES ('$email', '$password', '$vcode', '$type')");
    $link = "kam.nepal/auth/verify_code.php?email=$email&vcode=$vcode";
    $link = "<a href='$link'>" . $link . "</a>";
    $mailer = new Mailer();
    $mailer->sendMail($email, "Verify your Kam Nepal account", $link);

    $result = mysqli_query($con, "SELECT id FROM user WHERE email='$email'");

    while ($row = mysqli_fetch_array($result)) {
        mysqli_query($con, "INSERT INTO profile (user_id,fname,phone,category,profile_img) VALUES ('{$row['id']}','$fname','$phone','$category','uploads/default.png')");
    }
    session_start();
    $_SESSION['email'] = $email;
    echo '
        <script>
            location.href = "../dashboard.php";
        </script>
    ';
} catch (Exception $e) {
    echo $e->getMessage();
}
?>