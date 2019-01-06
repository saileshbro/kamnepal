<?php
include 'database/db.php';
$db = new Database;
$con = $db->con;
$fn = "$('.modal').fadeOut()";
if (isset($_POST['postId'])) {
  $output = "";
  $sql = "SELECT * FROM posts WHERE id ='" . $_POST['postId'] . "'";
  $result = mysqli_query($con, $sql);
  $output .= "<div class='modal-content'>
      <a class='modal-title' onclick=" . $fn . ">&times;
      </a>
      <div class='modal-body'>
        <div class='post-head'>
          <p class='heading-secondary'>";
  while ($row = mysqli_fetch_assoc($result)) {
    $output .= $row['title'] . "</p>
            </div>
            <div class='modal-post'>
              <div class='post-media'>"
      . "<img src='" . $row['media'] . "' alt='' width='200px' height='260px'>
              </div>" . "<div class='post-body'>" . html_entity_decode(htmlspecialchars_decode($row['body'])) . "
          </div>" .
      "</div>
          <div class='info'>
            <div class='posted-by'>BY:
              <p>ABC company</p>
            </div>
            <span class='posted-date'>" . $row['updated_at'] . "</span>
          </div></div></div>";
  }
}
echo $output;
?>