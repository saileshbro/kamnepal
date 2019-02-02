<?php
// end session here
session_start();
unset($_SESSION['email']);
session_destroy();
header("Location: login.php");
?>