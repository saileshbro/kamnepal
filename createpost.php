<?php
include_once 'database/db.php';
$db = new Database();
$con = $db->con;
$user_id = $_POST['user_id'] ?? "";//get id
$title = cleanse($_POST['title']) ?? "";//get title
$body = cleanse(htmlentities(htmlspecialchars($_POST['body']))) ?? "";///endode html chars
$type = getColumn("select type from user where id='$user_id'", 'type');//get type
if (isset($_FILES['image'])) {//if image is uploaded
  $fileName = $_FILES['image']['name'];//get file name
  $fileName = strtolower(preg_replace('/\s+/', '', $fileName));//remove spaces snd lowercase
  $fileErr = $_FILES['image']['error'];//get error code
  $fileExt = explode(".", $fileName);//get file ext
  $fileSize = $_FILES['image']['size'];//get size
  $fileTempName = $_FILES['image']['tmp_name'];//get temp name
  $fileExt = end($fileExt);//get ext
  $extensions = array('jpg', 'jpeg', 'png');//supported files
  if (in_array($fileExt, $extensions)) {//if supported
    if ($fileErr === 0) {//if no error
      if ($fileSize < 1000000) {//if less then that much bytes
        $fileName = "postimage" . getColumn("SHOW TABLE STATUS LIKE 'posts'", "Auto_increment");
        $fileName .= "." . $fileExt;
        $fileDest = "uploads/" . $fileName;
        if ($title == "" || $body == "") {//if empty post is made
          echo "";
          die();
        }
        if ($type == 'Jobseeker') {//for jobseeker

          if (move_uploaded_file($fileTempName, $fileDest)) {
            $category = getColumn("select category from profile where user_id='$user_id'", 'category');
            $sql = "insert into posts (user_id,title,body,media,category) values ('$user_id','$title','$body','$fileDest','$category')";
            mysqli_query($con, $sql);
          }
          echo "";
        }
        if ($type === "Employer") {//for employer
          if (move_uploaded_file($fileTempName, $fileDest)) {
            $category = cleanse($_POST['category']) ?? "";
            $sql = "insert into posts (user_id,title,body,media,category) values ('$user_id','$title','$body','$fileDest','$category')";
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
} else {//if no image
  if ($title == "" || $body == "") {
    echo "";
    die();
  }
  if ($type == 'Jobseeker') {
    $category = getColumn("select category from profile where user_id='$user_id'", 'category');
    $sql = "insert into posts (user_id,title,body,category) values ('$user_id','$title','$body','$category')";
    mysqli_query($con, $sql);
    echo "";
  }
  if ($type === "Employer") {
    $category = cleanse($_POST['category']) ?? "";
    $sql = "insert into posts (user_id,title,body,category) values ('$user_id','$title','$body','$category')";
    mysqli_query($con, $sql);
    echo "";
  }
}

?>