<?php
include("views/header.php");

if(isset($_POST['changePass'])){
  include("views/conn.php");
  $error = "";
  $success= "";
  $adminID = $_SESSION['id'];
  $currentPass = $_POST['currentPass'];
  $newPass = $_POST['newPass'];
  $confirmPass = $_POST['confirmPass'];

  $query = "SELECT password FROM admin WHERE id=".$adminID." ";
  $result = mysqli_query($link,$query);
  if(mysqli_num_rows($result)>0){
    $row = mysqli_fetch_array($result);
    if($currentPass == $row['password']) {
      if($newPass == $confirmPass){
        $query = "UPDATE admin SET password=".$newPass." WHERE id=".$adminID." ";
        if(mysqli_query($link,$query)){
          $success = "Your Password succesfully changed";
        }else{
          $error = "Error updating password. Try it later.";
        }
      }else{
        $error = "New Password and Confirm Password Field do not match.";
      }
    } else {
      $error = 'Invalid Password. Please Enter your current Pasword.';
    }
  }else{
    $error=  "Your current password is wrong";
  }
}

?>

<style>
  .errorWrap {
  padding: 10px;
  margin: 0 0 20px 0;
  background: #fff;
  border-left: 4px solid #dd3d36;
  -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
  box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
  padding: 10px;
  margin: 0 0 20px 0;
  background: #fff;
  border-left: 4px solid #5cb85c;
  -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
  box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
  </style>

<div class="container my-5">
  <div class="row">
    <div class="col-md-12">
      <h4>Admin Change Password</h4>
      <hr/>
    </div>

  </div>
  <div class="col-md-6 offset-md-3">
    <div class="card mb-3" >
      <div class="card-header text-white bg-dark ">Change Password</div>
      <div class="card-body">
        <?php
        if(!empty($error)){
          ?>    <div class="alert alert-danger"> <?php echo $error; ?></div>
        <?php }
        if(!empty($success)){ ?>
          <div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($success); ?> </div>
        <?php } ?>
        <form method="post">
          <h6 class="card-title">
            <div class="form-group">
              <label for="currentPass">Current Password</label>
              <input type="password" id="currentPass" name="currentPass" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="newPass">Enter new Password</label>
              <input type="password" id="newPass" name="newPass" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="confirmPass">Confirm Password</label>
              <input type="password" id="confirmPass" name="confirmPass" class="form-control" required>
            </div>
          </h6>
          <button class="btn btn-dark text-white" type="submit" name="changePass">Change Password</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include("views/footer.php"); ?>
