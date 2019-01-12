<?php
include "../database/db.php";
include "../auth/authenticate.php";
$db = new Database();
$con = $db->con;
$id = cleanse($_POST['id']) ?? "";
$sender_id = getColumn("select id from user where email='$email'", 'id');
$fname = getColumn("SELECT fname FROM profile WHERE user_id='$id'", "fname");
$num = mysqli_num_rows(mysqli_query($con, "SELECT * FROM chat WHERE (reciever_id='$id' AND sender_id='$sender_id') OR (reciever_id ='$sender_id' AND sender_id='$id')"));
?>
<img style="cursor:pointer;" onclick="location.href='../profile/jsk/display.php?user_id='+<?php echo $id; ?>" src=<?php echo "../" . getColumn("select profile_img from profile where user_id='$id'", 'profile_img') ?> alt="avatar" />
<div class="chat-about">
    <div class="chat-with">Chat with <?php echo $fname ?></div>
    <div class="chat-num-messages">Already <?php echo $num; ?> Messages</div>
</div>