<?php
// remove a post
include "../database/db.php";
$db = new Database();
$con = $db->con;
$deleteId = $_POST['id'];
$Id = substr($deleteId, 5, strlen($deleteId));
$path = getColumn("select media from posts where id='$Id'", 'media');
unlink("../" . $path);
$sql = "DELETE from posts where id='$Id'";
$res = mysqli_query($con, $sql);
?>