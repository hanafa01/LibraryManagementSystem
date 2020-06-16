<?php include("views/header.php") ?>

<?php
if((array_key_exists("id",$_SESSION) AND $_SESSION['id'])){
  // IMPORTANT!!! if we are in the loginpage, and we direct in the link to sign page.. it will still in the loggedinpage!
  header("Location: admin/dashboard.php");
}

if((array_key_exists("userId",$_SESSION) AND $_SESSION['userId'])){
  // IMPORTANT!!! if we are in the loginpage, and we direct in the link to sign page.. it will still in the loggedinpage!
  header("Location: dashboard.php");
}
?>

<div class="menu-section"></div>

<div class="container my-5">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <div class="card">
        <div class="card-header bg-dark text-white">
          <span id="loginInTitle">User Login</span>
        </div>
        <div class="card-body">
          <?php if(isset($_SESSION['error'])){
            if($_SESSION['error'] != ""){?>
            <div class="alert alert-danger"> <?php echo $_SESSION['error']; $_SESSION['error'] = ""; ?> </div>
          <?php }}?>
           <?php if(isset($_SESSION['success'])){
             if($_SESSION['success'] != ""){?>
             <div class="alert alert-success"> <?php echo $_SESSION['success']; $_SESSION['success'] = ""; ?> </div>
           <?php }}?>
            <input type="hidden" id="loginActive" name="loginActive" value="1"/>
            <div class="alert alert-danger" id="loginAlert"></div>

            <div class="form-group">
              <label for="email">Email Address</label>
              <input type="email" autocomplete="off" class="form-control" id="email">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password">
              <a href="forgotPassword.php" id="forgotPasswordLink" class="card-link text-muted">Forgot Password</a>
            </div>
            <button class="btn btn-dark text-white" id="loginForUsersAndLibButton">Login</button>
            <a href="signup.php" id="registerLink" class="card-link text-muted"> | Not Register Yet</a>
            <div class="float-right">
              <button class="btn btn-dark text-white" id="toggleLogin">Admin</button>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>

<?php include("views/footer.php") ?>
