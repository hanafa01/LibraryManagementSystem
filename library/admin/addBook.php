<?php
ob_start();

include("views/header.php");
      include("views/conn.php");?>

<?php

$query = "SELECT categoryName FROM `category`";
$result = mysqli_query($link,$query);


$query2 = "SELECT authorName FROM `author`";
$result2 = mysqli_query($link,$query2);

if(isset($_POST['submit'])){
  $bookName = $_POST['bookName'];
  $categoryName = $_POST['categoryName'];
  $authorName = $_POST['authorName'];
  $publisherName = $_POST['publisherName'];
  $publishingYear = $_POST['publishingYear'];
  $price = $_POST['price'];
  $isbn = $_POST['isbn'];
  $nbOfBook = $_POST['value'];

  $query = "SELECT ISBN FROM book WHERE ISBN='$isbn'";
  $result = mysqli_query($link,$query);
  if(mysqli_num_rows($result) > 0){
    $error = "This ISBN exists.";
  }else{
    $query = "INSERT INTO `book`(`bookName`,`categoryId`,`authorId`,`ISBN`,`publisherName`,`publicationYear`,`bookPrice`,`nbOfBook`) VALUES('".mysqli_real_escape_string($link,$bookName)."',(SELECT categoryId FROM category WHERE categoryName='".mysqli_real_escape_string($link,$categoryName)."'),(SELECT authorId FROM author WHERE authorName='".mysqli_real_escape_string($link,$authorName)."'),".mysqli_real_escape_string($link,$isbn).",'".mysqli_real_escape_string($link,$publisherName)."','".mysqli_real_escape_string($link,$publishingYear)."','".mysqli_real_escape_string($link,$price)."',".mysqli_real_escape_string($link,$nbOfBook).")";
    if($result = mysqli_query($link,$query)){
      $_SESSION['success'] = "Added Book.";
      header("location:manageBook.php");
      ob_enf_flush();
    }else{
      $_SESSION['errorr'] = "Error Adding Book, try it later.";
      header("location:manageBook.php");
      ob_enf_flush();
    }
  }
}


 ?>
 <script type="text/javascript">

  function increase(){
  var value = parseInt(document.getElementById('value').value, 10);
  value = isNaN(value) ? 0 : value;
  value++;
  document.getElementById('value').value = value;
  }

  function decrease(){
    var value = parseInt(document.getElementById('value').value, 10);
     if(value != 1){
       value--;
     }
     document.getElementById('value').value = value;
  }

 </script>

<div class="container my-5">
  <div class="row">
    <div class="col-md-12">
      <h4>ADD BOOK</h4>
      <hr/>
    </div>

  </div>
  <div class="col-md-6 offset-md-3">
    <div class="card mb-3" >
      <div class="card-header text-white bg-dark ">Book Info</div>
      <div class="card-body">
        <form method="post">
          <h6 class="card-title">
            <div class="form-group">
              <label for="bookName">Book Name<span style="color:red;">*</span></label>
              <input type="text" class="form-control" name="bookName" autocomplete="off" required>
            </div>
            <div class="form-group">
              <label for="isbn">ISBN<span style="color:red;">*</span></label>
              <input type="text" class="form-control" name="isbn" autocomplete="off" required>
              <small id="emailHelp" class="form-text text-muted">An ISBN is an International Standard Book Number. ISBN Must be unique</small>
            </div>
            <div class="form-group">
              <label for="category">Category<span style="color:red;">*</span></label>
              <select class="form-control" name="categoryName" required="required">
                <option value="">Select Category</option>
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                  <option name="categoryName" value="<?php echo $row['categoryName']?>"><?php echo $row['categoryName']?></option>
                <?php }?>
              </select>
            </div>
            <div class="form-group">
              <label for="authorName">Author<span style="color:red;">*</span></label>
              <select class="form-control" name="authorName" required="required">
                <option value="">Select Author</option>
                <?php while($row = mysqli_fetch_assoc($result2)) { ?>
                  <option name="authorName" value="<?php echo $row['authorName']?>"><?php echo $row['authorName']?></option>
                <?php }?>
              </select>
            </div>
            <div class="form-group">
              <label for="publisherName">Publisher Name<span style="color:red;">*</span></label>
              <input type="text" class="form-control" name="publisherName" autocomplete="off" required>
            </div>
            <div class="form-group">
              <label for="publisherName">Publishing Year<span style="color:red;">*</span></label>
              <input type="number" name="publishingYear" maxlength="4" class="form-control" autocomplete="off" required>
              <!-- pattern="\d{4}"  -->
            </div>
            <div class="form-group">
              <label for="bookPrice">Price<span style="color:red;">*</span></label>
              <input type="number" class="form-control" name="price" autocomplete="off" required>
            </div>
            <div class="form-group">
              <label for="bookPrice">Number Of Book(s)<span style="color:red;">*</span></label>
                <div class="input-group">
                  <span class="input-group-btn">
                      <button onclick="decrease()" type="button" class="btn btn-danger btn-number" >
                        <span class="fa fa-minus"></span>
                      </button>
                  </span>
                  <input type="text" id="value" name="value" class="form-control input-number" value="1" min="1" max="100" autocomplete="off" required>
                  <span class="input-group-btn">
                      <button onclick="increase()" type="button" class="btn btn-success btn-number">
                          <span class="fa fa-plus"></span>
                      </button>
                  </span>
                </div>
              </div>
          </h6>
          <button class="btn btn-dark text-white" type="submit" name="submit">Add</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include("views/footer.php"); ?>
