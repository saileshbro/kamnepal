<?php
$user_id = $_GET['user_id'];
$sql = "select * from experience where user_id='$user_id'";
$res = mysqli_query($con, $sql);

?>
<div class="modal-profile-2" id="modal-profile-2">
    <div class="exp-modal">
      <div class="exp-modal-head">
        <a href="#modal-profile-2" id='exp-modal-head'><p>&times;</p></a>
      </div>
      <div class="exp-modal-body">
        <h1>Experiences</h1>
        <?php
        while ($row = mysqli_fetch_array($res)) {
          echo "<div class='edu-content'>
                  <div class='degree'>
                    <p>" . $row['emp_title'] . "</p>
                    <p>" . $row['emp_start'] . " - " . $row['emp_end'] . "</p>
                  </div>
                  <h3 class='name-ins'>" . $row['emp_comp'] . "</h3>
                  <p id='body'>" . $row['emp_details'] . "</p>
                </div>";
        } ?>
      </div>
    </div>
</div>
