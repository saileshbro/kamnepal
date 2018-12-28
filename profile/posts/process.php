<?php
    include "../../database/db.php";
    $db = new Database();
    $con = $db->con;
  if(isset($_POST['eduId'])){
    $eduId = $_POST['eduId'];
    $sql = "DELETE FROM education WHERE id='$eduId'";
    $res = mysqli_query($con,$sql);
    if($res){
        echo "Education Section deleted successfully";
    }else{
        echo"Ops! error occured.";
    }
  }
  if(isset($_POST['empId'])){
      $empId = $_POST['empId'];
      $sql = "DELETE FROM experience WHERE id='$empId'";
      $res = mqsqli_query($con,$sql);
      if($res){
          echo "<script>location.reload()</script>";
      }
  }
  ?>