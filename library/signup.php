<?php include("views/header.php"); include("views/conn.php");?>
<?php
$error = "";
if(isset($_POST['signUp'])){
  $pass = $_POST['password'];
  $confirmPass = $_POST['confirmPassword'];
  $email = $_POST['email'];
  if($pass == $confirmPass){
    $query = "SELECT email FROM user WHERE email = '".mysqli_real_escape_string($link,$email)."'";
    $result = mysqli_query($link,$query);
    if(mysqli_num_rows($result) > 0){
      $error = "This email already exist.";
    }else{
      $hash = password_hash(mysqli_real_escape_string($link,$_POST['password']), PASSWORD_DEFAULT);
      $query = "INSERT INTO `user`(`firstName`,`lastName`,`mobileNumber`,`email`,`password`) VALUES('".mysqli_real_escape_string($link,$_POST['fname'])."','".mysqli_real_escape_string($link,$_POST['lname'])."','".mysqli_real_escape_string($link,$_POST['mobileNumber'])."','".mysqli_real_escape_string($link,$_POST['email'])."','$hash')";
      if($result = mysqli_query($link,$query)){
        $row = mysqli_fetch_array($result);
        $_SESSION['success'] = "Welcome ".$_POST['fname']."! Your cardID is ".mysqli_insert_id($link);

        header("location:index.php");
      }else{
        $_SESSION['error'] = "There was error signing up, try it later.";
        header("location:index.php");
      }
    }
  }else{
    $error = "These Password doesn't match";
  }
}
 ?>

<div class="menu-section"></div>
<div class="container my-5">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <div class="card">
        <form method="post">
            <div class="card-header bg-dark text-white">
              <span id="loginInTitle">User Sign Up</span>
            </div>
            <div class="card-body">
              <?php if($error != ""){ ?>
                <div class="alert alert-danger"><?php echo $error ?></div>
              <?php } ?>
                <div class="form-group">
                  <label for="fname">First Name<span style="color:red;">*</span></label>
                  <input type="text" name="fname" class="form-control" autocomplete="off" required>
                </div>
                <div class="form-group">
                  <label for="lname">Last Name<span style="color:red;">*</span></label>
                  <input type="text" name="lname" class="form-control" autocomplete="off" required>
                </div>
                <div class="form-group">
                  <label for="mobileNumber">Mobile Number<span style="color:red;">*</span></label>
                  <input type="number" name="mobileNumber" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="email">Email Address<span style="color:red;">*</span></label>
                  <input type="email" name="email" class="form-control" autocomplete="off" required>
                </div>
                <div class="form-group">
                  <label for="password">Password<span style="color:red;">*</span></label>
                  <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="password">Confirm Password<span style="color:red;">*</span></label>
                  <input type="password" name="confirmPassword" class="form-control" required>
                </div>
                <button class="btn btn-dark text-white" name="signUp">Sign Up</button>
                <a href="index.php" class="card-link text-muted"> | Already have an Account?</a>
              </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include("views/footer.php"); ?>
