<?php
// **************FETCH MESSAGES***************
include "../database/db.php";
include "../auth/authenticate.php";
$db = new Database();
$con = $db->con;
// sender id is the logged in user
$sender_id = getColumn("select id from user where email='$email'", 'id');
// reciever id from get request URL
$reciever_id = $_GET['id'];
$reciever_name = getColumn("select fname from profile where user_id='$reciever_id'", 'fname');
$sender_name = getColumn("select fname from profile where user_id='$sender_id'", 'fname');
// two way query
$sql = "SELECT * FROM chat WHERE (reciever_id='$reciever_id' AND sender_id='$sender_id') OR (reciever_id ='$sender_id' AND sender_id='$reciever_id') ORDER BY id DESC LIMIT 20";
$res = mysqli_query($con, $sql);
$chats = array();
// get chat in array
while ($row = mysqli_fetch_array($res)) {
    $chats[] = $row;
}
// reverse chat to get latest at the last
$chats = array_reverse($chats);
foreach ($chats as $chat) {
    if ($chat['sender_id'] === $sender_id) {
        // ************SENDER PART IN UI*************
        ?>
    <li class="clearfix">
            <div class="message-data align-right">
              <span class="message-data-time" ><?php echo $chat['sent_at']; ?></span> &nbsp; &nbsp;
              <span class="message-data-name" ><?php echo $sender_name; ?></span> <i class=" me"></i>
            </div>
            <div class="message other-message float-right">
                <?php echo $chat['message']; ?>
            </div>
          </li>
    <?php

} else {
    // ***********Reciever part in ui************
    ?>
    <li>
            <div class="message-data">
              <span class="message-data-name"><i class="online"></i><?php echo $reciever_name; ?></span>
              <span class="message-data-time"><?php echo $chat['sent_at']; ?></span>
            </div>
            <div class="message my-message">
            <?php echo $chat['message']; ?>
            </div>
          </li>
        <?php

    }
}
// set message as seen while having conversation
$sql = "UPDATE chat SET seen='1' where reciever_id='$reciever_id' and sender_id='$sender_id'";
mysqli_query($con, $sql);
// set notification as seen while having conversation
$sql = "UPDATE notice SET status='1' where reciever_id='$sender_id' and sender_id='$reciever_id'";
mysqli_query($con, $sql);