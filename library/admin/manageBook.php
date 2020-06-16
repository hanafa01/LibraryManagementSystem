<?php
ob_start();

include("views/header.php");
include("views/conn.php");

  $query = "SELECT * FROM `book`,`category`,`author` WHERE category.categoryId = book.categoryId AND author.authorId = book.authorId";
  $result = mysqli_query($link,$query);

  if(isset($_GET['delisbn'])){
     $queryStatus = "SELECT returnStatus FROM reservation,book WHERE reservation.bookId = book.bookId AND book.ISBN = ".$_GET['delisbn']."";
     $resultStatus = mysqli_query($link,$queryStatus);
     $rowStatus = mysqli_fetch_assoc($resultStatus);
     if($rowStatus['returnStatus'] == 1) {
        $query = "DELETE FROM `book` WHERE ISBN=".$_GET['delisbn']." ";   // delete only in book table... putting foreign key with delete cascdae will delete in book and reservation table.
        if($result = mysqli_query($link,$query)){
          $_SESSION['success'] = "Deleted Book.";
          header("location:manageBook.php");
          ob_enf_flush();
        }else{
          $_SESSION['errorr'] = "Error Deleting Book.";
          header("location:manageBook.php");
          ob_enf_flush();
        }
      }else{
          $_SESSION['errorr'] = "Cannot Delete Book. There is someone was reserved this book.";
          header("location:manageBook.php");
          ob_enf_flush();
      }
  }

 ?>

 <div class="container my-5">
   <div class="row">
     <div class="col-md-12">
       <h4>MANAGE BOOKS</h4>
       <hr/>
     </div>
   </div>

   <div class="col-md-12">

         <?php if(isset($_SESSION['errorr'])){
           if($_SESSION['errorr'] != ""){?>
           <div class="alert alert-danger"> <?php echo $_SESSION['errorr']; $_SESSION['errorr'] = ""; ?> </div>
         <?php }}?>
          <?php if(isset($_SESSION['success'])){
            if($_SESSION['success'] != ""){?>
            <div class="alert alert-success"> <?php echo $_SESSION['success']; $_SESSION['success'] = ""; ?> </div>
          <?php }}?>

         <div class="table-responsive">
            <table id="book_table" class="table table-striped table-bordered table-sm"  width="100%">
             <thead>
               <tr>
                 <th scope="col">#</th>
                 <th scope="col">Book Name</th>
                 <th scope="col">ISBN</th>
                 <th scope="col">Category Name</th>
                 <th scope="col">Author Name</th>
                 <th scope="col">Publisher Name</th>
                 <th scope="col">Publication Year</th>
                 <th scope="col">Price</th>
                 <th scope="col"># of Book</th>
                 <th scope="col">Action</th>
               </tr>
             </thead>
             <tbody>
               <?php
              $count = 1;
               while($row = mysqli_fetch_assoc($result)) {  ?>
                 <tr>
                  <td><?php echo $count ?></td>
                  <td><?php echo $row['bookName'] ?></td>
                  <td><?php echo $row['ISBN'] ?></td>
                  <td><?php echo $row['categoryName'] ?></td>
                  <td><?php echo $row['authorName'] ?></td>
                  <td><?php echo $row['publisherName'] ?></td>
                  <td><?php echo $row['publicationYear'] ?></td>
                  <td><?php echo $row['bookPrice'] ?></td>
                  <td><?php if($row['nbOfBook'] == 0){?>
                    <a><button class="btn btn-danger">Not Available</button></a>
                  <?php }else{
                    echo $row['nbOfBook']; }?></td>
                  <td>
                    <a href="editBook.php?isbn=<?php echo $row['ISBN'];?>"><button class="btn btn-primary"><i class="fa fa-pencil fa-fw"></i> Edit</button>
                    <a href="manageBook.php?delisbn=<?php echo $row['ISBN']; ?>" onclick="return confirm('Are you sure you want to delete?');" ><button class="btn btn-danger"><i class="fa fa-trash-o fa-fw"></i> Delete</button>
                  </td>
                </tr>
          <?php
          $count++;
            } ?>
             </tbody>
           </table>
         </div>
       </div>
</div>
</div>

 </div>
<?php include("views/footer.php"); ?>

<script type="text/javascript">
 $(document).ready(function(){
   $('table').DataTable({
     "lengthMenu": [10,15,20,25,30,35,40,45,50],
     "columnDefs": [
       { "searchable": false, "targets": 9  }
     ],
     "columnDefs": [
       { "orderable": false, "targets": 9 }
     ]
   });
 });
</script>
