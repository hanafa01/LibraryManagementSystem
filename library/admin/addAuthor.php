<?php
ob_start();
include("views/header.php"); ?>
<?php
if(isset($_POST['authorName'])){
  $error = "";
  if($_POST['authorName']){
    include("views/conn.php");
    $query = "SELECT * FROM `author` WHERE authorName='".mysqli_real_escape_string($link,$_POST['authorName'])."'";
    $result = mysqli_query($link,$query);
    if(mysqli_num_rows($result)>0){
      $error = "This Author Name exists.";
    }else{
    $query = "INSERT INTO `author`(`authorName`) VALUES ('".mysqli_real_escape_string($link,$_POST['authorName'])."') ";
      if($result = mysqli_query($link,$query)){
        $_SESSION['success'] = "Added Author.";
        header("location:manageAuthor.php");
        ob_enf_flush();
      }else{
        $_SESSION['errorr'] = "Error Adding Author, try it later.";
        header("location:manageAuthor.php");
        ob_enf_flush();
      }
    }
  }else{
    $error = "The author name is empty.";
  }
}
 ?>
<div class="container my-5">
  <div class="row">
    <div class="col-md-12">
      <h4>ADD AUTHOR</h4>
      <hr/>
    </div>

  </div>
  <div class="col-md-6 offset-md-3">
    <div class="card mb-3" >
      <div class="card-header text-white bg-dark ">AUTHOR Info</div>
      <div class="card-body">
        <?php if(isset($error)!=""){
          ?>    <div class="alert alert-danger"> <?php echo $error; ?></div>
        <?php } ?>
        <form method="post">
          <h6 class="card-title">
            <div class="form-group">
              <label for="author">Author Name</label>
              <input type="text" id="authorName" name="authorName" class="form-control" autocomplete="off" required>
            </div>
          </h6>
          <button class="btn btn-dark text-white">Add</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include("views/footer.php"); ?>
