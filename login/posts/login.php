<?php
include('../../database/db.php');
$db = new Database();
$con = $db->con;
$email = cleanse($_POST['email']) ?? '';
$password = cleanse($_POST['password']) ?? '';
$password = md5($password . $email);
$num = mysqli_num_rows(mysqli_query($con, "SELECT id FROM user WHERE email='$email' AND password='$password'"));
if ($num > 0) {
    session_start();
    $_SESSION['email'] = $email;
    $user_id = getColumn("SELECT id FROM user WHERE email='$email'", "id");
    echo '
    <script>
        location.href = "../dashboard.php?user_id=' . $user_id . '";
    </script>';
} else {
    echo ('Email and password incorrect.');
}
?>