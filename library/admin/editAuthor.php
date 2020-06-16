<?php
ob_start();
include("views/header.php");
include("views/conn.php");

$getData = "SELECT * FROM `author` WHERE authorId = ".$_GET['authorid']." ";
$result = mysqli_query($link,$getData);
$row = mysqli_fetch_array($result);
?>
<?php
if(isset($_POST['authorName'])){
  $error = "";
  if($_POST['authorName']){
    $query2 = "SELECT * FROM `author` WHERE authorName='".mysqli_real_escape_string($link,$_POST['authorName'])."'";
    $result2 = mysqli_query($link,$query2);
    if(mysqli_num_rows($result2)>0){
      $error = "This Author Name exists.";
    }else{
      $query3 = "UPDATE `author` SET `authorName`='".mysqli_real_escape_string($link,$_POST['authorName'])."' WHERE authorId = ".$_GET['authorid']." ";
      if($result3 = mysqli_query($link,$query3)){
        $_SESSION['success'] = "Updated Author.";
        header("location:manageAuthor.php");
        ob_enf_flush();
      }else{
        $_SESSION['errorr'] = "Error Updating Author, try it later.";
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
              <input type="text" id="authorName" name="authorName" value="<?php echo $row['authorName']; ?>" class="form-control" autocomplete="off" required>
            </div>
          </h6>
          <button class="btn btn-dark text-white">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include("views/footer.php"); ?>
