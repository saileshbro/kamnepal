<?php
include 'database/db.php';
$db = new Database();
$con = $db->con;
$user_id = $_POST['user_id']; //get user id of the author
$title = cleanse($_POST['title']) ?? "";//title of the post
$body = cleanse(htmlentities(htmlspecialchars($_POST['body']))) ?? ""; //encode the html characters
$type = getColumn("select type from user where id='$user_id'", "type"); //get post
$postId = $_POST['postId'];
if (isset($_FILES['image'])) {//if image was uploaded
    $fileName = $_FILES['image']['name'];
    $fileName = strtolower(preg_replace('/\s+/', '', $fileName));//removint the spaces and lowering the chars
    $fileErr = $_FILES['image']['error'];//checking if any error code
    $fileExt = explode(".", $fileName);
    $fileExt = end($fileExt);//getting the extension
    $fileSize = $_FILES['image']['size'];//get file size
    $fileTempName = $_FILES['image']['tmp_name'];//get temp file name
    $extensions = array('jpg', 'jpeg', 'png'); //restricting the extensions
    if (in_array($fileExt, $extensions)) {//if contains extensions
        if ($fileErr === 0) {//if no error
            if ($fileSize < 1000000) {//if less then that much bits
                $fileName = "postimage" . $postId;//assiging post it to the image
                $fileName .= "." . $fileExt;//adding the extension to the post
                $fileDest = "uploads/" . $fileName;//setting the destination path
                if ($title == "" || $body == "") {//if body or title of the post is empty
                    echo "";
                    die();
                }
                if ($type == 'Jobseeker') {//for type jobseeker

                    if (move_uploaded_file($fileTempName, $fileDest)) {
                        $sql = "update posts set title='$title',body='$body',media='$fileDest',updated_at=CURRENT_TIMESTAMP where id='$postId'";
                        $res = mysqli_query($con, $sql);
                    }
                    echo "";
                }
                if ($type === "Employer") {//for type employer
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
} else {//if no image was uploaded
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