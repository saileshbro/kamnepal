<?php
include 'database/db.php';
$db = new Database();
$con = $db->con;
$user_id = $_POST['user_id'];
$title = cleanse($_POST['title']) ?? "";
$body = cleanse(htmlentities(htmlspecialchars($_POST['body']))) ?? "";
$type = getColumn("select type from user where id='$user_id'", "type");
$postId = $_POST['postId'];
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
                $fileName = "postimage" . $postId;
                $fileName .= "." . $fileExt;
                $fileDest = "uploads/" . $fileName;
                if ($title == "" || $body == "") {
                    echo "";
                    die();
                }
                if ($type == 'Jobseeker') {

                    if (move_uploaded_file($fileTempName, $fileDest)) {
                        $sql = "update posts set title='$title',body='$body',media='$fileDest',updated_at=CURRENT_TIMESTAMP where id='$postId'";
                        $res = mysqli_query($con, $sql);
                    }
                    echo "";
                }
                if ($type === "Employer") {
                    if (move_uploaded_file($fileTempName, $fileDest)) {
                        $category = cleanse($_POST['category']) ?? "";
                        $sql = "update posts set title='$title',body='$body',category='$category',media='$fileDest',updated_at=CURRENT_TIMESTAMP where id='$postId'";
                        $res = mysqli_query($con, $sql);
                    }
                    echo "";
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
    if ($type === "Jobseeker") {

        $sql = "update posts set title='$title',body='$body',updated_at=CURRENT_TIMESTAMP where id='$postId'";
        $res = mysqli_query($con, $sql);

    } else {
        $category = cleanse($_POST['category']) ?? "";
        $sql = "update posts set title='$title',body='$body',category='$category',updated_at=CURRENT_TIMESTAMP where id='$postId'";
        $res = mysqli_query($con, $sql);
    }
}
?>