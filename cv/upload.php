<?php
if (isset($_FILES['image'])) {
    $profImg = "../uploads/default.png";
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
                    $fileName = "cv";
                    $fileName .= "." . $fileExt;
                    $fileDest = "../uploads/" . $fileName;
                    move_uploaded_file($fileTempName, $fileDest);
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

}