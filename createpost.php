<?php
include_once 'database/db.php';
$db = new Database();
$con = $db->con;
$user_id = $_POST['user_id'] ?? "";
$title = cleanse($_POST['title']) ?? "";
$body = cleanse(htmlentities(htmlspecialchars($_POST['body']))) ?? "";
$type = getColumn("select type from user where id='$user_id'", 'type');

if ($type == 'Jobseeker') {
    $category = getColumn("select category from profile where user_id='$user_id'", 'category');
    $sql = "insert into posts (user_id,title,body,category) values ('$user_id','$title','$body','$category')";
    mysqli_query($con, $sql);
}
if ($type === "Employer") {
    $category = cleanse($_POST['category']) ?? "";
    $sql = "insert into posts (user_id,title,body,category) values ('$user_id','$title','$body','$category')";
    mysqli_query($con, $sql);
}
?>