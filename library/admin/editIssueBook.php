<?php
ob_start();
include("views/header.php");
include("views/conn.php");
$query = "SELECT * FROM `reservation`,`book`,`user` WHERE reservationId=".$_GET['rid']." AND book.bookId = reservation.bookId AND reservation.userId = user.userId";
$result = mysqli_query($link,$query);
$row = mysqli_fetch_array($result);?>
<?php
$remain = $row['bookPrice']-$row['pricePaid'];

if(isset($_POST['update'])){
  $price = $_POST['price']; //admin will type the price   5
  $pricePaid = $row['pricePaid']; // paid by user         10
  $totalPrice = $pricePaid + $price;                      //5+10 = 15

  if($price>$remain){                       // 3>3
    echo "You must pay $remain USD or below";
  }else{
    $query = "UPDATE `reservation` SET pricePaid=".$totalPrice." WHERE reservationId=".$_GET['rid']." ";
    if(mysqli_query($link,$query)){
      $_SESSION['success'] = "Updated Successfully.";
      header("location:manageIssueBook.php");
    }else{
      $_SESSION['errorr'] = "Error, try it later.";
      header("location:manageIssueBook.php");
    }
  }
}

 ?>
<style>
label{
  font-weight: bold;
}
</style>
<div class="container my-5">
  <div class="row">
    <div class="col-md-12">
      <h4>ISSUED BOOK DETAILS</h4>
      <hr/>
    </div>
  </div>

  <div class="col-md-6 offset-md-3">
    <div class="card mb-3" >
      <div class="card-header text-white bg-dark ">Issued book details</div>
      <div class="card-body">
        <?php if(isset($error)!=""){
          ?>    <div class="alert alert-danger"> <?php echo $error; ?></div>
        <?php } ?>
        <form method="post">

          <div class="form-group">
            <label>User Name :</label>
            <?php echo $row['firstName']." ".$row['lastName'];?>
          </div>
          <div class="form-group">
            <label>Book Name :</label>
            <?php echo $row['bookName'];?>
          </div>
          <div class="form-group">
            <label>ISBN :</label>
            <?php echo $row['ISBN'];?>
          </div>
          <div class="form-group">
            <label>Book Pick Up Date :</label>
            <?php echo $row['pickDate'];?>
          </div>
          <div class="form-group">
            <label>Book Returned Date :</label>
            <?php if($row['returnDate'] == NULL){ echo "Not returned Yet";
                  }else{
              echo $row['returnDate'];
            } ?>
          </div>
          <div class="form-group">
            <label>Paid: </label>
            <?php echo $row['pricePaid']." of ".$row['bookPrice']." USD" ?>
          </div>
          <?php if($remain > 0){ ?>
          <div class="form-group">
            <label class="text-danger">Remain <?php echo $remain." USD"?></label>
            <input class="form-control" type="text" name="price" id="price" autocomplete="off" required />
          </div>
        <button class="btn btn-dark text-white" type="submit" name="update">Update</button>
      <?php }else{
        ?> <div class="alert alert-success">
            <strong>Success!</strong> You paid the reservation price .
          </div><?php
      }?>
      </form>
      </div>
    </div>
  </div>
</div>

<?php include("views/footer.php"); ?>
