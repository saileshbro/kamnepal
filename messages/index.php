<?php
require '../auth/authenticate.php';
require '../database/db.php';
$db = new Database();
$con = $db->con;
$sender_id = getColumn("select id from user where email = '$email'", 'id');
$reciever_id = cleanse($_GET['id']) ?? "";
$reciever_name = getColumn("select fname from profile where user_id='$reciever_id'", 'fname');
$sender_name = getColumn("select fname from profile where user_id='$sender_id'", 'fname');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <title>Kam Nepal | Messages</title>
</head>
<body>
    <?php
    require '../index-nav.php';
    ?>
    <section class='messageBody'>
    <div class="people-list" id="people-list">
      <ul class="list">
        <li class="clearfix">
          <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_01.jpg" alt="avatar" />
          <div class="about">
            <div class="name">Vincent Porter</div>
            <div class="status">
              <i class=" online"></i> online
            </div>
          </div>
        </li>
        
        <li class="clearfix">
          <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_02.jpg" alt="avatar" />
          <div class="about">
            <div class="name">Aiden Chavez</div>
            <div class="status">
              <i class=" offline"></i> left 7 mins ago
            </div>
          </div>
        </li>
        
        <li class="clearfix">
          <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_03.jpg" alt="avatar" />
          <div class="about">
            <div class="name">Mike Thomas</div>
            <div class="status">
              <i class=" online"></i> Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum, minus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut magni beatae recusandae harum ratione tempore optio aliquid labore incidunt repudiandae.
            </div>
          </div>
        </li>
        
        <li class="clearfix">
          <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_04.jpg" alt="avatar" />
          <div class="about">
            <div class="name">Erica Hughes</div>
            <div class="status">
              <i class=" online"></i> online
            </div>
          </div>
        </li>
        
        <li class="clearfix">
          <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_05.jpg" alt="avatar" />
          <div class="about">
            <div class="name">Ginger Johnston</div>
            <div class="status">
              <i class=" online"></i> online
            </div>
          </div>
        </li>
        
        <li class="clearfix">
          <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_06.jpg" alt="avatar" />
          <div class="about">
            <div class="name">Tracy Carpenter</div>
            <div class="status">
              <i class=" offline"></i> left 30 mins ago
            </div>
          </div>
        </li>
        
        <li class="clearfix">
          <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_07.jpg" alt="avatar" />
          <div class="about">
            <div class="name">Christian Kelly</div>
            <div class="status">
              <i class=" offline"></i> left 10 hours ago
            </div>
          </div>
        </li>
        
        <li class="clearfix">
          <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_08.jpg" alt="avatar" />
          <div class="about">
            <div class="name">Monica Ward</div>
            <div class="status">
              <i class=" online"></i> online
            </div>
          </div>
        </li>
        
        <li class="clearfix">
          <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_09.jpg" alt="avatar" />
          <div class="about">
            <div class="name">Dean Henry</div>
            <div class="status">
              <i class=" offline"></i> offline since Oct 28
            </div>
          </div>
        </li>
        
        <li class="clearfix">
          <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_10.jpg" alt="avatar" />
          <div class="about">
            <div class="name">Peyton Mckinney</div>
            <div class="status">
              <i class=" online"></i> online
            </div>
          </div>
        </li>
      </ul>
</div>
    <!-- right side -->
    <div class="chat">
      <div class="chat-header clearfix">
        <img style="cursor:pointer;" onclick="location.href='../profile/jsk/display.php?user_id='+<?= $reciever_id ?>" src=<?php echo "../" . getColumn("select profile_img from profile where user_id='$reciever_id'", 'profile_img') ?> alt="avatar" />
        
        <div class="chat-about">
          <div class="chat-with">Chat with <?php echo $reciever_name ?></div>
          <div class="chat-num-messages">already <?php echo mysqli_num_rows(mysqli_query($con, "SELECT * FROM chat WHERE (reciever_id='$reciever_id' AND sender_id='$sender_id') OR (reciever_id ='$sender_id' AND sender_id='$reciever_id')")) ?> messages</div>
        </div>
      </div> <!-- end chat-header -->
      
      <div class="chat-history" id="msgs">
        <ul id="chatHistory">
          
        </ul>
      </div> <!-- end chat-history -->
      
      <div class="chat-message">
        <textarea name="message-to-send" id="message-to-send" placeholder ="Type your message" rows="3"></textarea>        
        <button onclick="sendMessage();"> <i class="fab fa-telegram-plane"></i>Send</button>
      </div> <!-- end chat-message -->
      
    </div> <!-- end chat -->

    </section>
    <?php require('../includes/footer.php'); ?>
    <script src="/js/app.js"></script>
    <script>
  var src = "<?= $profileImg ?>";
  src = "../."+src;
  $('#nav-pro-img').attr("src",src);
  $('.dropdown-profile-mid img').attr("src",src);

  function sendMessage(){
    $.ajax({
      type: "POST",
      url : "sendmessage.php",
      data: {
        reciever: "<?= $reciever_id ?>",
        message: $('#message-to-send').val()
      },
      success: (data)=>{
        
        fetchMessages();
      }
    });
    $('#message-to-send').val("");
  }
  function fetchMessages(){
    $.ajax({
      type: 'GET',
      url: 'fetchMessages.php',
      data:{
        id: "<?= $reciever_id ?>"
      },
      success: (data)=>{
        $('#chatHistory').html(data);
          $('#msgs').animate({
                scrollTop: $('#msgs')[0].scrollHeight}, "slow");
          }
    });
  }
  fetchMessages();
  setInterval(fetchMessages,8000);
  $('#message-to-send').on('keypress',function(e) {
    if(e.which == 13) {
      sendMessage();
    }
});
</script>
</body>
</html>