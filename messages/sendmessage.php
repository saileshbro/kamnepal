<?php
include "../auth/authenticate.php";
include "../database/db.php";
$db = new Database;
$con = $db->con;
$sender_id = getColumn("SELECT id FROM user WHERE email='$email'", "id");
$reciver_id = cleanse($_POST['reciever']) ?? "";
$message = cleanse($_POST['message']) ?? "";
$sql = "INSERT INTO chat (sender_id,reciever_id,message) VALUES ('$sender_id','$reciver_id','$message')";
mysqli_query($con, $sql);
$sql = "SELECT id FROM notice WHERE sender_id='$sender_id' AND reciever_id='$reciver_id'";
$res = mysqli_query($con, $sql);
if (mysqli_num_rows($res) > 0) {
    $sql = "UPDATE notice SET status='0',notice_time=CURRENT_TIMESTAMP WHERE sender_id = '$sender_id' AND reciever_id='$reciver_id' AND type='msg'";
    mysqli_query($con, $sql);
} else {
    $sql = "INSERT INTO notice (reciever_id,sender_id,type) values ('$reciver_id','$sender_id','msg')";
    mysqli_query($con, $sql);
}