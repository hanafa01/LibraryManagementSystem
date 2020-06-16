<?php
ob_start();
include("views/header.php");
include("views/conn.php");

$query1 = "SELECT categoryName FROM `category`";
$result1 = mysqli_query($link,$query1);


$query2 = "SELECT authorName FROM `author`";
$result2 = mysqli_query($link,$query2);

$getData = "SELECT * FROM `book`,`category`,`author` WHERE category.categoryId = book.categoryId AND author.authorId = book.authorId AND ISBN = ".$_GET['isbn']." ";
$result = mysqli_query($link,$getData);
$row = mysqli_fetch_array($result);
?>
<?php
if(isset($_POST['submit'])){
  $error = "";
  if($_POST['bookName']){
      $getCategyByName = "SELECT categoryId FROM category WHERE categoryName = '".mysqli_real_escape_string($link,$_POST['categoryName'])."' LIMIT 1";
      $resultForGetCategoryByName = mysqli_query($link,$getCategyByName);
      $rowCateg = mysqli_fetch_assoc($resultForGetCategoryByName);
      $getAuthorByName = "SELECT authorId FROM author WHERE authorName = '".mysqli_real_escape_string($link,$_POST['authorName'])."' LIMIT 1";
      $resultForGetAuthorByName = mysqli_query($link,$getAuthorByName);
      $rowAuthor = mysqli_fetch_assoc($resultForGetAuthorByName);
      $query3 = "UPDATE `book` SET `bookName`='".mysqli_real_escape_string($link,$_POST['bookName'])."',`categoryId`=".mysqli_real_escape_string($link,$rowCateg['categoryId']).",`authorId`=".mysqli_real_escape_string($link,$rowAuthor['authorId']).",`publisherName`='".mysqli_real_escape_string($link,$_POST['publisherName'])."',`publicationYear`='".mysqli_real_escape_string($link,$_POST['publishingYear'])."',`bookPrice`='".mysqli_real_escape_string($link,$_POST['price'])."',`nbOfBook`=".mysqli_real_escape_string($link,$_POST['value'])." WHERE ISBN = ".$_GET['isbn']." ";
      if($result3 = mysqli_query($link,$query3)){
        $_SESSION['success'] = "Updated Book.";
        header("location:manageBook.php");
        ob_enf_flush();
      }else{
        $_SESSION['errorr'] = "Error Updating Book, try it later.";
        header("location:manageBook.php");
        ob_enf_flush();
      }

  }else{
    $error = "The book name is empty.";
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
     value = isNaN(value) ? 0 : value;
     value < 1 ? value = 1 : '';
     value--;
     document.getElementById('value').value = value;
  }

 </script>
 <div class="container my-5">
   <div class="row">
     <div class="col-md-12">
       <h4>UPDATE BOOK</h4>
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
               <input type="text" class="form-control" name="bookName" value="<?php echo $row['bookName']; ?>" autocomplete="off" required>
             </div>
             <div class="form-group">
               <label for="category">Category<span style="color:red;">*</span></label>
               <select class="form-control" name="categoryName" required="required">
                 <option value="">Select Category</option>
                 <?php while($row2 = mysqli_fetch_assoc($result1)) { ?>
                   <option name="categoryName" value="<?php echo $row2['categoryName']?>"><?php echo $row2['categoryName']?></option>
                 <?php }?>
               </select>
             </div>
             <div class="form-group">
               <label for="authorName">Author<span style="color:red;">*</span></label>
               <select class="form-control" name="authorName" value="<?php echo $row['authorName']; ?>" required="required">
                 <option value="">Select Author</option>
                 <?php while($row3 = mysqli_fetch_assoc($result2)) { ?>
                   <option name="authorName"><?php echo $row3['authorName']?></option>
                 <?php }?>
               </select>
             </div>
             <div class="form-group">
               <label for="publisherName">Publisher Name<span style="color:red;">*</span></label>
               <input type="text" class="form-control" value="<?php echo $row['publisherName'] ?>" name="publisherName" autocomplete="off" required>
             </div>
             <div class="form-group">
               <label for="publisherName">Publishing Year<span style="color:red;">*</span></label>
               <input type="number" name="publishingYear" value="<?php echo $row['publicationYear'] ?>" class="form-control" autocomplete="off" required>
               <!--  pattern="\d{4}"  -->
             </div>
             <div class="form-group">
               <label for="bookPrice">Price<span style="color:red;">*</span></label>
               <input type="number" class="form-control" name="price" value="<?php echo $row['bookPrice'] ?>" autocomplete="off" required>
             </div>
             <div class="form-group">
               <label for="bookPrice">Number Of Book(s)<span style="color:red;">*</span></label>
                 <div class="input-group">
                   <span class="input-group-btn">
                       <button onclick="decrease()" type="button" class="btn btn-danger btn-number" >
                         <span class="fa fa-minus"></span>
                       </button>
                   </span>
                   <input type="text" id="value" name="value" class="form-control input-number" value="<?php echo $row['nbOfBook']?>" min="1" max="100" autocomplete="off" required>
                   <span class="input-group-btn">
                       <button onclick="increase()" type="button" class="btn btn-success btn-number">
                           <span class="fa fa-plus"></span>
                       </button>
                   </span>
                 </div>
               </div>
           </h6>
           <button class="btn btn-dark text-white" type="submit" name="submit">Update</button>
         </form>
       </div>
     </div>
   </div>
 </div>

<?php include("views/footer.php"); ?>
