<?php
require '../auth/authenticate.php';
require '../database/db.php';
$db = new Database();
$con = $db->con;
$sender_id = getColumn("select id from user where email = '$email'", 'id');
$sender_name = getColumn("select fname from profile where user_id='$sender_id'", 'fname');
$lastConv = getColumn("SELECT reciever_id FROM chat WHERE sender_id='$sender_id' ORDER BY id DESC LIMIT 1", 'reciever_id');
if (isset($_GET['id'])) {
  $reciever_id = cleanse($_GET['id']) ?? "";
  $reciever_name = getColumn("select fname from profile where user_id='$reciever_id'", 'fname');
} else {
  $reciever_name = getColumn("select fname from profile where user_id='$lastConv'", 'fname');
  header('Location: ?id=' . $lastConv);
}
if (!mysqli_num_rows(mysqli_query($con, "SELECT id from user where id='$reciever_id'")) > 0) {
  header('Location: ?id=' . $lastConv);
}
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
    <div class="search">
        <input type="text" oninput="search(this.value);"placeholder="search" />
        <i class="fa fa-search"></i>
      </div>
      <ul class="list">
      </ul>
    </div>
    <!-- right side -->
    <div class="chat">
      <div class="chat-header clearfix">
        
      </div> <!-- end chat-header -->
      
      <div class="chat-history" id="msgs">
        <ul id="chatHistory">
          
        </ul>
      </div> <!-- end chat-history -->
      
      <div class="chat-message">
        <input name="message-to-send" id="message-to-send" placeholder ="Type your message">
        <button onclick="sendMessage();"> <i class="fab fa-telegram-plane"></i>Send</button>
      </div> <!-- end chat-message -->
      
    </div> <!-- end chat -->

    </section>
    <?php require('../includes/footer.php'); ?>
    <script src="/js/app.js"></script>
    <script>
    var id = "<?= $reciever_id ?>";
    var src = "<?= $profileImg ?>";
    src = "../."+src;
    $('#nav-pro-img').attr("src",src);
    $('.dropdown-profile-mid img').attr("src",src);

    function getChatHeader(){
      $.ajax({
        type: 'POST',
        url:"chatheader.php",
        data:{
          id : id
        },
        success:(data)=>{
          $('.chat-header').html(data);
        }
      });
    }
    getChatHeader();
    function changeChat(chaTiD){
      id=chaTiD;
      fetchMessages();
      getChatHeader();
    } 
    function fetchRecent(){
      $.ajax({
        type: 'GET',
        url:"fetchRecent.php",
        data:{
          sender_id : "<?= $sender_id ?>"
        },
        success:(data)=>{
          $('#people-list .list').html(data);
        }
      });
    }
    fetchRecent();
    function sendMessage(){
    if($('#message-to-send').val()!=''){
      $.ajax({
      type: "POST",
      url : "sendmessage.php",
      data: {
        reciever: id,
        message: $('#message-to-send').val()
      },
      success: (data)=>{
        fetchMessages();
        fetchRecent();
        getChatHeader();
      }
    });
    $('#message-to-send').val("");
    }else{}
  }
  function fetchMessages(){
    $.ajax({
      type: 'GET',
      url: 'fetchMessages.php',
      data:{
        id: id
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
function search(query){
  let people = $("li.clearfix div.about .name");
  query = query.toLowerCase();
  let textVal;
  for(let i=0;i<people.length;i++){
    textVal=people[i].textContent || people[i].innerText;
    if(textVal.toLowerCase().indexOf(query)>-1){
      people[i].parentElement.parentElement.style.display="";
    }else{
      people[i].parentElement.parentElement.style.display="none";
    }
  }
}
</script>
</body>
</html>