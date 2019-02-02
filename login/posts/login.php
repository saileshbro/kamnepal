<?php
include('../../database/db.php');
$db = new Database();
$con = $db->con;
$email = cleanse($_POST['email']) ?? '';//get email
$password = cleanse($_POST['password']) ?? '';//get password
$password = md5($password . $email);//hash password
$num = mysqli_num_rows(mysqli_query($con, "SELECT id FROM user WHERE email='$email' AND password='$password'"));
if ($num > 0) {
    // if found in db
    session_start();
    $_SESSION['email'] = $email;
    $user_id = getColumn("SELECT id FROM user WHERE email='$email'", "id");
    echo '
    <script>
        location.href = "../dashboard.php";
    </script>';
} else {
    echo ('Email and password incorrect.');
}
?>