<?php
include "../database/db.php";
include "../auth/authenticate.php";
$db = new Database();
$con = $db->con;

$sender_id = getColumn("select id from user where email='$email'", 'id');
$reciever_id = $_GET['id'];
$reciever_name = getColumn("select fname from profile where user_id='$reciever_id'", 'fname');
$sender_name = getColumn("select fname from profile where user_id='$sender_id'", 'fname');
$sql = "SELECT * FROM chat WHERE (reciever_id='$reciever_id' AND sender_id='$sender_id') OR (reciever_id ='$sender_id' AND sender_id='$reciever_id') ORDER BY id DESC LIMIT 20";
$res = mysqli_query($con, $sql);
$chats = array();
while ($row = mysqli_fetch_array($res)) {
    $chats[] = $row;
}
$chats = array_reverse($chats);
foreach ($chats as $chat) {
    if ($chat['sender_id'] === $sender_id) {
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