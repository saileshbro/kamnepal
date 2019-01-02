<?php
$user_id = $_GET['user_id'];
$sql = "select * from education where user_id='$user_id'";
$res = mysqli_query($con, $sql);

?>
<div class="modal-profile-1" id="modal-profile-1">
    <div class="edu-modal">
      <div class="edu-modal-head">
        <a href="#modal-profile-1" id='edu-modal-head'><p>&times;</p></a>
      </div>
      <div class="edu-modal-body">
        <h1 class='heading-secondary'>Education</h1>
        <?php
        while ($row = mysqli_fetch_array($res)) {
          echo "<div class='edu-content'>
                  <div class='degree'>
                    <p>" . $row['course_title'] . "</p>
                    <p>" . $row['start_year'] . " - " . $row['end_year'] . "</p>
                  </div>
                  <h3 class='name-ins'>" . $row['inst_name'] . "</h3>
                  <p id='body'>" . $row['details'] . "</p>
                </div>";
        } ?>
      </div>
    </div>
</div>
