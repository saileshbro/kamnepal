<?php
if (!session_id()) {
    session_start();
}

$email = $_SESSION['email'] ?? "";
if (strlen($email) === 0) {
    header('Location: /login/login.php');
    die();
}
?>