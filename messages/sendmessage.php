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