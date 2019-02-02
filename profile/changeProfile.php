<?php
// change profile picture
require('../auth/authenticate.php');
require('../database/db.php');
$db = new Database;
$con = $db->con;
$user_id = getColumn("SELECT id FROM user WHERE email='$email'", "id");
if (isset($_FILES['image'])) {
    $fileName = $_FILES['image']['name'];
    $fileName = strtolower(preg_replace('/\s+/', '', $fileName));
    $fileErr = $_FILES['image']['error'];
    $fileExt = explode(".", $fileName);
    $fileSize = $_FILES['image']['size'];
    $fileTempName = $_FILES['image']['tmp_name'];
    $fileExt = end($fileExt);
    $extensions = array('jpg', 'jpeg', 'png');
    if (in_array($fileExt, $extensions)) {
        if ($fileErr === 0) {
            if ($fileSize < 1000000) {
                $fileName = "avatar" . $user_id;
                $fileName .= "." . $fileExt;
                $fileDest = "uploads/" . $fileName;
                move_uploaded_file($fileTempName, '../' . $fileDest);
                $res = mysqli_query($con, "update profile set profile_img ='$fileDest' where user_id='$user_id'");
                if ($res) {
                    echo "succesfully changed";
                }
            } else {
                echo "file too big";
            }
        } else {
            echo "Error uploading file.";
        }

    } else {
        echo "Not supported file type.";
    }
} else {
    echo "file not set";
}