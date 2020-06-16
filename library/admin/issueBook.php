<?php
ob_start();
include("views/header.php");
include("views/conn.php");

if(array_key_exists("submit",$_POST)){
  $queryBook = "SELECT bookId,nbOfBook FROM book WHERE ISBN='".mysqli_real_escape_string($link,$_POST['isbn'])."' LIMIT 1";
  if($resultBook = mysqli_query($link,$queryBook)){
    $rowBook = mysqli_fetch_array($resultBook);
    if($rowBook['nbOfBook'] == 0){
      $error = "This book is not available right now.";
    }else{
      $q = "SELECT count(userId) as nbOfUserReserved FROM reservation WHERE userId=".mysqli_real_escape_string($link,$_POST['studentid'])." AND returnStatus = '0'";
      $r = mysqli_query($link,$q);
      $row = mysqli_fetch_assoc($r);
      if($row['nbOfUserReserved'] < 5){
        $query = "INSERT INTO `reservation`(`bookId`, `userId`, `pickDate`, `mustBeforeDate`) VALUES ('".$rowBook['bookId']."',".mysqli_real_escape_string($link,$_POST['studentid']).",NOW(),DATE_ADD(now(),INTERVAL 2 WEEK))";
        if(mysqli_query($link,$query)){
            $rowBook['nbOfBook'] = $rowBook['nbOfBook'] - 1;
           $queryUpdate = "UPDATE book SET nbOfBook=".$rowBook['nbOfBook']." WHERE ISBN='".mysqli_real_escape_string($link,$_POST['isbn'])."' ";
           if(mysqli_query($link,$queryUpdate)){
             $_SESSION['success'] = "Book Issued.";
             header("location:manageIssueBook.php");
             ob_enf_flush();
           }else{
             $_SESSION['errorr'] = "Error Issuing, try it later.";
             header("location:manageIssueBook.php");
             ob_enf_flush();
           }
        }else{
          $error = "There was error reserve book. Try it later.";
        }
      }else{
        $error = "You have maximum books. You must return one or more books.";
      }
    }
  }else{
    $error = "There was error reserve book. Try it later.";
  }
}
?>

<script>

function getbook() {
  $.ajax({
    type: "POST",
    url: "getBook.php",
    data: {isbn: $("#isbn").val()},
    success: function(data){
      $("#get_book_name").html(data);
    }
  });
}
function getStudent() {
  $.ajax({
    type: "POST",
    url: "getStudent.php",
    data: {userid: $("#studentid").val()},
    success: function(data){
      $("#get_student_name").html(data);
    }
  });
}

</script>

<div class="container my-5">
  <div class="row">
    <div class="col-md-12">
      <h4>ISSUE A NEW BOOK</h4>
      <hr/>
    </div>
  </div>

  <div class="col-md-6 offset-md-3">
    <div class="card mb-3" >
      <div class="card-header text-white bg-dark ">Issue a new book</div>
      <div class="card-body">
        <?php if(isset($error)!=""){
          ?>    <div class="alert alert-danger"> <?php echo $error; ?></div>
        <?php } ?>
        <form method="post">
        <h6 class="card-title">
          <div class="form-group">
            <label for="studentid">Student ID<span style="color:red;">*</span></label>
            <input type="text" id="studentid" name="studentid" onBlur="getStudent()" class="form-control" autocomplete="off" required>
          </div>
          <div class="form-group">
            <span id="get_student_name" class="form-text text-muted"></span>
          </div>
          <div class="form-group">
            <label for="studentid">ISBN<span style="color:red;">*</span></label>
            <input type="text" id="isbn" name="isbn" onBlur="getbook()" class="form-control" autocomplete="off" required>
          </div>
          <div class="form-group">
           <select  class="form-control" name="bookdetails" id="get_book_name" readonly>
           </select>
          </div>
        </h6>
        <input type="submit" class="btn btn-dark text-white" id="submit" name="submit" value="Issue Book">
      </form>
      </div>
    </div>
  </div>
</div>

<?php include("views/footer.php"); ?>
