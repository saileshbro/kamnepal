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

    // $output .= "<div class='create-post'>";
    // $output .= "<form id='createPost'><a class='modal-title' onclick=" . $fn . ">&times;</a>";
    // $output .= "<h2>Edit Post</h2>";
    // if ($type === 'Jobseeker') {
    //     $output .= "<div class='inp-grp' style='width:100%;'>";
    // } else {
    //     $output .= "<div class='inp-grp' style='width:95%;'>";
    // }
    // $title = getColumn("select title from posts where id='$Id'", "title");
    // $output .= "<input type='text' id='title' placeholder='Title of your post'>";
    // if ($type === 'Employer') {
    //     $output .= "<select name='category' ><option value='Jobs Category' selected='true' disabled='disabled'>Category</option>";
    //     $sql = "select * from category";
    //     $res = mysqli_query($con, $sql);
    //     if ($res) {
    //         while ($row = mysqli_fetch_array($res)) {
    //             $output .= "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
    //         }
    //         $output .= "</select>";
    //     }

    // }
    // $output .= "</div>";
    // $output .= "<div style='margin: 0 20px; margin-bottom:20px; border-radius:5px;'>";
    // $output .= "<textarea class='fr-view' name='createpost' id='editor' cols='30' style='display:none;' rows='10' placeholder='Body of your post'></textarea>";
    // $output .= "</div>";
    // $output .= "<div class='create-button'><input type='file' name='file'><a href='javascript:;' id='create-button' class='button-primary'>Update</a></div></form></div>";
    // echo ($output);
}
$sql = "Select title,body,category from posts where id='$Id'";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);
$row['body'] = html_entity_decode(htmlspecialchars_decode($row['body']));
$row['type'] = $type;
echo json_encode($row);
?>