<?php
// if session is not started, start the session
if (!session_id()) {
    session_start();
}
// get email
$email = $_SESSION['email'] ?? "";
if (strlen($email) === 0) {
    header('Location: ../login/login.php');
    die();
}
?>