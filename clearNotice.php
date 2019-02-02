<?php
require "database/db.php";
$db = new Database();
$con = $db->con;
if ($_POST['type'] === 'single') {
// clear a notice
    $notice_id = $_POST['notice_id'];
    $sql = "UPDATE notice SET status = '1' WHERE id='$notice_id'";
    $res = mysqli_query($con, $sql);
}
if ($_POST['type'] === 'all') {
// clear all notice
    $user_id = $_POST['user_id'];
    $sql = "UPDATE notice SET status = '1' WHERE reciever_id='$user_id'";
    $res = mysqli_query($con, $sql);
}