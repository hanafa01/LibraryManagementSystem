<?php
include("views/conn.php");
$userid = $_POST['userid'];

$query = "SELECT firstName,lastName FROM user WHERE userId=$userid LIMIT 1";
if($result = mysqli_query($link,$query)){
  if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_array($result);
    echo $row['firstName']." ".$row['lastName'];
    echo "<script>$('#submit').prop('disabled',false);</script>";
  }else{
    echo "<span id='get_student_name' class='form-text text-danger'>Invaid Student Id. Please Enter Valid Student id.</span>";
    echo "<script>$('#submit').prop('disabled',true);</script>";
  }
}else{
  echo "<span id='get_student_name' class='form-text text-danger'>Invaid Student Id. Please Enter Valid Student id.</span>";
  echo "<script>$('#submit').prop('disabled',true);</script>";
}

 ?>
