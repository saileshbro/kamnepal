<?php
include "../database/db.php";
$db = new Database();
$con = $db->con;
$deleteId = $_POST['id'];
$Id = substr($deleteId, 5, strlen($deleteId));
$sql = "DELETE from posts where id='$Id'";
$res = mysqli_query($con, $sql);
?>