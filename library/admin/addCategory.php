<?php
ob_start();

include("views/header.php"); ?>
<?php

if(isset($_POST['categoryName'])){
  $error = "";
  if($_POST['categoryName']){
    include("views/conn.php");
    $query = "SELECT * FROM `category` WHERE categoryName='".mysqli_real_escape_string($link,$_POST['categoryName'])."'";
    $result = mysqli_query($link,$query);
    if(mysqli_num_rows($result)>0){
      $error = "This Category Name exists.";
    }else{
      $query = "INSERT INTO `category`(`categoryName`) VALUES ('".mysqli_real_escape_string($link,$_POST['categoryName'])."') ";
      if($result = mysqli_query($link,$query)){
        $_SESSION['success'] = "Created Category.";
        header("location:manageCategory.php");
        ob_enf_flush();
      }else{
        $_SESSION['errorr'] = "Error Creating Category, try it later.";
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
            <input type="text" id="categoryName" name="categoryName" class="form-control" autocomplete="off" required>
          </div>
        </h6>
        <button class="btn btn-dark text-white">Create</button>
      </form>
      </div>
    </div>
  </div>
</div>

<?php include("views/footer.php"); ?>
