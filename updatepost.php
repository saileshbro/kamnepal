<?php
include 'database/db.php';
$db = new Database();
$con = $db->con;
$user_id = $_POST['user_id'];
$type = getColumn("select type from user where id='$user_id'", "type");
$postId = $_POST['postId'];
if ($type === "Jobseeker") {
    $title = cleanse($_POST['title']) ?? "";
    $body = cleanse(htmlentities(htmlspecialchars($_POST['body']))) ?? "";
    $sql = "update posts set title='$title',body='$body' where id='$postId'";
    $res = mysqli_query($con, $sql);

} else {
    $title = cleanse($_POST['title']) ?? "";
    $body = cleanse(htmlentities(htmlspecialchars($_POST['body']))) ?? "";
    $category = cleanse($_POST['category']) ?? "";
    $sql = "update posts set title='$title',body='$body',category='$category' where id='$postId'";
    $res = mysqli_query($con, $sql);
    if ($res) {
        echo ('Updated');
    }
}

?>