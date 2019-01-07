<?php
include_once 'database/db.php';
$db = new Database();
$con = $db->con;
$user_id = $_POST['user_id'] ?? "";
$title = cleanse($_POST['title']) ?? "";
$body = cleanse(htmlentities(htmlspecialchars($_POST['body']))) ?? "";
$type = getColumn("select type from user where id='$user_id'", 'type');
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
        $fileName = "postimage" . getColumn("SHOW TABLE STATUS LIKE 'posts'", "Auto_increment");
        $fileName .= "." . $fileExt;
        $fileDest = "uploads/" . $fileName;
        if ($title == "" || $body == "") {
          echo "";
          die();
        }
        if ($type == 'Jobseeker') {

          if (move_uploaded_file($fileTempName, $fileDest)) {
            $category = getColumn("select category from profile where user_id='$user_id'", 'category');
            $sql = "insert into posts (user_id,title,body,media,category) values ('$user_id','$title','$body','$fileDest','$category')";
            mysqli_query($con, $sql);
          }
          echo "";
        }
        if ($type === "Employer") {
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
} else {
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