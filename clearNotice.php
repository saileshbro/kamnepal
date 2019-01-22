<?php
require "database/db.php";
$db = new Database();
$con = $db->con;
if ($_POST['type'] === 'post') {
    $notice_id = $_POST['notice_id'];
    $sql = "UPDATE notice SET status = '1' WHERE id='$notice_id'";
    $res = mysqli_query($con, $sql);
    if ($res) {
        echo $notice_id;
    }

}