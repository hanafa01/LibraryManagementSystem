<?php
ob_start();

include("views/header1.php");
include("views/conn.php");

  $query = "SELECT * FROM `book`,`category`,`author` WHERE category.categoryId = book.categoryId AND author.authorId = book.authorId";
  $result = mysqli_query($link,$query);

 ?>

 <div class="container my-5">
   <div class="row">
     <div class="col-md-12">
       <h4>BOOKS</h4>
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
            <table id="book_table" class="table table-striped table-bordered table-sm" cellspacing="0"  width="100%">
             <thead>
               <tr>
                 <th scope="col">#</th>
                 <th scope="col">Book Name</th>
                 <th scope="col">ISBN</th>
                 <th scope="col">Author Name</th>
                 <th scope="col">Publisher Name</th>
                 <th scope="col">Publication Year</th>
                 <th scope="col">Updation Date</th>
                 <th scope="col">Price</th>
                 <th scope="col">Reserve Book</th>
               </tr>
             </thead>
             <tbody>
               <?php
              $count = 1;
               while($row = mysqli_fetch_assoc($result)) { ?>
                 <tr>
                  <td><?php echo $count ?></td>
                  <td><?php echo $row['bookName'] ?></td>
                  <td><?php echo $row['ISBN'] ?></td>
                  <td><?php echo $row['authorName'] ?></td>
                  <td><?php echo $row['publisherName'] ?></td>
                  <td><?php echo $row['publicationYear'] ?></td>
                  <td><?php
                  echo $row['updationDate']
                  // $yourDateTime = $row['updationDate'];
                  // echo date('Y-m-d', strtotime($yourDateTime));
                  ?></td>
                  <td><?php echo $row['bookPrice'] ?></td>
                  <td><?php if($row['nbOfBook'] == 0){
                     $query2 = "SELECT min(mustBeforeDate) AS lastestDate FROM reservation WHERE bookId = ".$row['bookId']." ";
                     $result2 = mysqli_query($link,$query2);
                     $row2 = mysqli_fetch_assoc($result2);
                     if(mysqli_num_rows($result2) > 0){ ?>
                       <a href=""><button class="btn btn-danger disabled">Available Till <?php echo date('Y-m-d', strtotime($row2['lastestDate']));?></button></a>
                     <?php }else{?>
                       <a href=""><button class="btn btn-danger">Not Available</button></a>
                     <?php }
                      }else{
                        ?>
                        <a data-id="<?php echo $row['bookId'];?>" class="open-AddBookDialog btn btn-dark text-white"  data-toggle="modal" data-target="#myModal">Reserve</a>
                        <!-- <button class="btn btn-dark show-modal" onclick="location.href='books.php?bookId=<?php //echo $row['bookId'];?>';" data-toggle="modal" data-target="#myModal" type="submit">Reserve</button> -->
                      <?php } ?></td>
                </tr>
          <?php
          $count++;
            } ?>
             </tbody>
           </table>
         </div>
       </div>


       <!-- The Modal -->
       <div data-backdrop="static" data-keyboard="false" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
         <div class="modal-dialog">
           <div class="modal-content">

             <!-- Modal Header -->
             <div class="modal-header">
               <h4 class="modal-title">Pickup Date:</h4>
               <button type="button" class="close" data-dismiss="modal">&times;</button>
             </div>

             <!-- Modal body -->
             <div class="modal-body">
               <div class="alert alert-danger" id="errorAlert"></div>
               <form method="post">
                  <div class="input-group date" data-provide="datepicker">
                    <input type="date" name="start_date" id="getPickedDate" class="daterange form-control" required="required" style="background: #fff;">
                  </div>
               </form>
            </div>
             <!-- Modal footer -->
             <div class="modal-footer">
               <?php
               // $start_date = "2015/03/02";
               // $date = strtotime($start_date);
               // $date = strtotime("+14 day", $date);
               ?>
                <!-- <span class="mr-auto">Return Before <span class="text-danger"><?php //echo date('Y/m/d', $date); ?></span></span> -->
                 <button type="button" id="addPickDate" name="addPickDate" class="btn btn-dark">Reserve</button>
                 <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
             </div>
           </div>
         </div>
       </div>

     </div>
</div>

<?php include("views/footer1.php"); ?>

<script type="text/javascript">

 $(document).ready(function(){

   $('#book_table').DataTable({
    "bPaginate": false,
    "bLengthChange": false,
    "bFilter": true,
    "bInfo": false,
    "bAutoWidth": false
   });

   var myBookId;
   $(".open-AddBookDialog").click(function(){
     myBookId = $(this).data('id');
   });

   $("#addPickDate").click(function(){
     //var myBookId = $(".open-AddBookDialog").data('id');
     //alert(myBookId);
     $.ajax({
       type: "POST",
       url: "actions.php?action=addPickDate",
       data: "pickDate=" + $("#getPickedDate").val() + "&bookId=" + myBookId,
       success: function(data1){
         if(data1 == 1){
           window.location.assign("reservation.php");
         }else{
           $("#errorAlert").html(data1).show();
         }
       }
     });
   });


   $(".show-modal").click(function(){
           $("#myModal").modal({
               backdrop: 'static',
               keyboard: false
           });
       });

 });
</script>
