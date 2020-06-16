<?php
ob_start();
include("views/header.php");
include("views/conn.php");

$getData = "SELECT * FROM `category` WHERE categoryId = ".$_GET['categid']." ";
$result = mysqli_query($link,$getData);
$row = mysqli_fetch_array($result);?>
<?php

if(isset($_POST['categoryName'])){
  $error = "";
  if($_POST['categoryName']){
    $query2 = "SELECT * FROM `category` WHERE categoryName='".mysqli_real_escape_string($link,$_POST['categoryName'])."'";
    $result2 = mysqli_query($link,$query2);
    if(mysqli_num_rows($result2)>0){
      $error = "This Category Name exists.";
    }else{
      $query3 = "UPDATE `category` SET `categoryName`='".mysqli_real_escape_string($link,$_POST['categoryName'])."' WHERE categoryId = ".$_GET['categid']." ";
      if($result3 = mysqli_query($link,$query3)){
        $_SESSION['success'] = "Updated Category.";
        header("location:manageCategory.php");
        ob_enf_flush();
      }else{
        $_SESSION['errorr'] = "Error Updating Category, try it later.";
        header("location:manageCategory.php");
        ob_enf_flush();
      }
    }
  }else{
    $error = "The category name is empty.";
  }
}

 ?>

<div class="container my-5">
  <div class="row">
    <div class="col-md-12">
      <h4>ADD CATEGORY</h4>
      <hr/>
    </div>
  </div>

  <div class="col-md-6 offset-md-3">
    <div class="card mb-3" >
      <div class="card-header text-white bg-dark ">Category Info</div>
      <div class="card-body">
        <?php if(isset($error)!=""){
          ?>    <div class="alert alert-danger"> <?php echo $error; ?></div>
        <?php } ?>
        <form method="post">
        <h6 class="card-title">
          <div class="form-group">
            <label for="categoryName">Category Name</label>
            <input type="text" id="categoryName" name="categoryName" value="<?php echo $row['categoryName'];?>" class="form-control" autocomplete="off" required>
          </div>
        </h6>
        <button class="btn btn-dark text-white">Update</button>
      </form>
      </div>
    </div>
  </div>
</div>

<?php include("views/footer.php"); ?>
