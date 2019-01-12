<?php
include "../database/db.php";
include "../auth/authenticate.php";
$db = new Database();
$con = $db->con;
function searchForId($id, $arrayX)
{
    foreach ($arrayX as $array) {
        if ($array['sender_id'] === $id || $array['reciever_id'] === $id) {
            return true;
        }
    }
    return false;
}

$sender_id = getColumn("select id from user where email='$email'", 'id');

$result = mysqli_query($con, "SELECT * FROM chat WHERE sender_id='$sender_id' or reciever_id='$sender_id' GROUP BY sender_id,reciever_id ORDER BY id DESC");

$msgs = array();

while ($row = mysqli_fetch_assoc($result)) {
    $msgs[] = $row;
}

$msgs_filtered = array();

foreach ($msgs as $msg) {
    if ($msg['sender_id'] === $sender_id) {
        if (!searchForId($msg['reciever_id'], $msgs_filtered)) {
            $msgs_filtered[] = $msg;
        }
    } else {
        if (!searchForId($msg['sender_id'], $msgs_filtered)) {
            $msgs_filtered[] = $msg;
        }
    }
}

$history = array();
foreach ($msgs_filtered as $sms) {
    if ($sms['sender_id'] === $sender_id) {
        $history[] = $sms['reciever_id'];
    }
    if ($sms['reciever_id'] === $sender_id) {
        $history[] = $sms['sender_id'];
    }
}

foreach ($history as $hist) {
    $name = getColumn("SELECT fname FROM profile WHERE user_id='$hist'", "fname");
    $lastMsg = getColumn("SELECT message FROM chat WHERE (sender_id='$sender_id' AND reciever_id='$hist') OR (sender_id='$hist' AND reciever_id='$sender_id') ORDER BY id DESC LIMIT 1", "message");
    $profile_img = getColumn("SELECT profile_img FROM profile where user_id='$hist'", "profile_img");
    echo '<li style="cursor:pointer;" onclick="changeChat(\'' . $hist . '\')" class="clearfix">
            <img src="../' . $profile_img . '" id="' . $hist . '"  alt="avatar" />
            <div class="about">
            <div class="name">' . $name . '</div>
            <div class="status">' . $lastMsg . '</div>
            </div>
        </li>';
}