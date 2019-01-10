<?php
require '../auth/authenticate.php';
require '../database/db.php';
$db = new Database();
$con = $db->con;
?><!DOCTYPE html>
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
    
    <div class="chat">
      <div class="chat-header clearfix">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_01_green.jpg" alt="avatar" />
        
        <div class="chat-about">
          <div class="chat-with">Chat with Vincent Porter</div>
          <div class="chat-num-messages">already 1 902 messages</div>
        </div>
      </div> <!-- end chat-header -->
      
      <div class="chat-history">
        <ul>
          <li class="clearfix">
            <div class="message-data align-right">
              <span class="message-data-time" >10:10 AM, Today</span> &nbsp; &nbsp;
              <span class="message-data-name" >Olia</span> <i class=" me"></i>
              
            </div>
            <div class="message other-message float-right">
              Hi Vincent, how are you? How is the project coming along?
            </div>
          </li>
          
          <li>
            <div class="message-data">
              <span class="message-data-name"><i class=" online"></i> Vincent</span>
              <span class="message-data-time">10:12 AM, Today</span>
            </div>
            <div class="message my-message">
              Are we meeting today? Project has been already finished and I have results to show you.
            </div>
          </li>
          
          <li class="clearfix">
            <div class="message-data align-right">
              <span class="message-data-time" >10:14 AM, Today</span> &nbsp; &nbsp;
              <span class="message-data-name" >Olia</span> <i class=" me"></i>
              
            </div>
            <div class="message other-message float-right">
              Well I am not sure. The rest of the team is not here yet. Maybe in an hour or so? Have you faced any problems at the last phase of the project?
            </div>
          </li>
          
          <li>
            <div class="message-data">
              <span class="message-data-name"><i class=" online"></i> Vincent</span>
              <span class="message-data-time">10:20 AM, Today</span>
            </div>
            <div class="message my-message">
              Actually everything was fine. I'm very excited to show this to our team.
            </div>
          </li>          
        </ul>
        
      </div> <!-- end chat-history -->
      
      <div class="chat-message clearfix">
        <textarea name="message-to-send" id="message-to-send" placeholder ="Type your message" rows="3"></textarea>        
        <button> <i class="fab fa-telegram-plane"></i>Send</button>

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
</script>
</body>
</html>