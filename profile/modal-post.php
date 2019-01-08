<?php
include '../database/db.php';
$db = new Database;
$con = $db->con;
$sql1 = "select * from category";
$res1 = mysqli_query($con, $sql1);
$fn = "$('.modal-post-form').fadeOut()";
$output = "";
if (isset($_POST['editId'])) {
    $Id = $_POST['editId'];
    $user = getColumn("select user_id from posts where id='$Id'", "user_id");
    $type = getColumn("select type from user where id='$user'", 'type');
}
$sql = "Select title,body,category from posts where id='$Id'";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);
$row['body'] = html_entity_decode(htmlspecialchars_decode($row['body']));
$row['type'] = $type;
echo json_encode($row);
?>