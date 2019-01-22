<?php
require '../../auth/authenticate.php';
require '../../database/db.php';
$db = new Database();
$con = $db->con;
$userID = getColumn("select id from user where email='$email'", 'id');//logged in viewer
$user_id = $userID . ',';
$post_id = cleanse($_POST['post_id']) ?? "";
$publisherId = getColumn("Select user_id from posts where id='$post_id'", 'user_id');
$sql = "update posts set interested=concat(interested,'$user_id') where id='$post_id'";
$str = getColumn("select interested from posts where id = '$post_id'", "interested");
$str = substr($str, 0, strlen($str) - 1);
$userArr = explode(',', $str);

if (in_array($userID, $userArr)) {
    if (($key = array_search($userID, $userArr)) !== false) {
        unset($userArr[$key]);
        $str = implode(',', $userArr) . ',';
        $res = mysqli_query($con, "update posts set interested='$str' where id = '$post_id'");
    }
    mysqli_query($con, "DELETE FROM notice where post_id='$post_id'");
    echo "remove";
} else {
    if (mysqli_query($con, $sql)) {
        echo "add";
    }
    $sql = "INSERT INTO notice (reciever_id,sender_id,type,post_id) VALUES ('$publisherId','$userID','post','$post_id')";
    mysqli_query($con, $sql);
}
?>