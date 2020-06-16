<?php
include("views/conn.php");
$isbn = $_POST['isbn'];
$invalid = "Invalid ISBN Number.";

$query = "SELECT bookName FROM book WHERE ISBN=$isbn LIMIT 1";
if($result = mysqli_query($link,$query)){
  if(mysqli_num_rows($result) > 0){

    while($row =  mysqli_fetch_array($result)) {
      echo "<option value=".$row['bookName'].">".$row['bookName']."</option>";
      echo "<script>$('#submit').prop('disabled',false);</script>";
    }
    // $row = mysqli_fetch_array($result);
    // echo "<option value=".$row['bookName'].">".$row['bookName']."</option>";
    // echo "<script>$('#submit').prop('disabled',false);</script>";
  }else{
    echo "<option value=".$invalid.">".$invalid."</option>";
    echo "<script>$('#submit').prop('disabled',true);</script>";
  }
}

 ?>
