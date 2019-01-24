<?php
require "database/db.php";
$db = new Database();
$con = $db->con;
$userId = $_POST['user_id'];
$sql = "SELECT * FROM notice where reciever_id='$userId' order by notice_time desc";
$res = mysqli_query($con, $sql);
if (mysqli_num_rows($res) > 0) {
    ?>
    <li class="clear" onclick="clearNotice();getNotice();"><a href="javascript:;"><i class="fas fa-eraser"></i>Clear</a></li>
    <?php
    while ($row = mysqli_fetch_array($res)) {
        $poster = getColumn("SELECT fname FROM profile where user_id=" . $row['sender_id'] . "", "fname");
        $postName = getColumn("SELECT title FROM posts where id=" . $row['post_id'] . "", "title");
        if ($row['status'] == '0') {
            if ($row['type'] === 'post') {
                ?>
            <li id="<?php echo $row['id']; ?>" onclick="openNotice(this.id);">
            <div class="post-link">
                <i onclick="location.href='/posts/index.php?id=<?php echo $row['post_id']; ?>'" class="fas fa-file-signature" style="cursor:pointer;"></i><p><a href="javascript:;" onclick="location.href='/profile/jsk/display.php?user_id=<?php echo $row['sender_id']; ?>'">
                    <?php echo $poster; ?></a> viewed your post <span style="cursor:pointer;" onclick="location.href='/posts/index.php?id=<?php echo $row['post_id']; ?>'"><?php echo $postName; ?></span></p>
                </div>
            </li>
            <script>
                $('i.far.fa-bell').addClass('notice');
            </script>
            <?php

        } else {
            ?>
            <li id="<?php echo $row['id']; ?>" onclick="openNotice(this.id);">
            <div class="post-link">
                <i onclick="location.href='/messages/index.php?id=<?php echo $row['sender_id']; ?>'" class="fas fa-envelope" style="cursor:pointer;"></i><p><a href="javascript:;" onclick="location.href='/profile/jsk/display.php?user_id=<?php echo $row['sender_id']; ?>'">
                    <?php echo $poster; ?></a> sent you a message.</p>
                </div>
            </li>
            <script>
                $('i.far.fa-bell').addClass('notice');
            </script>
            <?php


        }
    } else {
        if ($row['type'] === 'post') {
            ?>
        <li class="seenNotice" id="<?php echo $row['id']; ?>" onclick="openNotice(this.id);"><div class="post-link"><i onclick="location.href='/posts/index.php?id=<?php echo $row['post_id']; ?>'" class="fas fa-file-signature" style="cursor:pointer;"></i><p><a href="javascript:;" onclick="location.href='/profile/jsk/display.php?user_id=<?php echo $row['sender_id']; ?>'"><?php echo $poster; ?></a> viewed your post <span style="cursor:pointer;" onclick="location.href='/posts/index.php?id=<?php echo $row['post_id']; ?>'"><?php echo $postName; ?></span></p></div></li>
            <?php

        } else {
            ?>
        <li class="seenNotice" id="<?php echo $row['id']; ?>" onclick="openNotice(this.id);"><div class="post-link"><i onclick="location.href='/messages/index.php?id=<?php echo $row['sender_id']; ?>'" class="fas fa-envelope" style="cursor:pointer;"></i><p><a href="javascript:;" onclick="location.href='/profile/jsk/display.php?user_id=<?php echo $row['sender_id']; ?>'"><?php echo $poster; ?></a> sent you a message.</p></div></li>
            <?php

        }
    }
}
} else {
    echo "null";
}
?>