<?php
ob_start();
include("views/header.php");
include("views/conn.php");

  $query = "SELECT * FROM `reservation`";
  $result = mysqli_query($link,$query);
  while($row = mysqli_fetch_assoc($result)){
    $twoWeek = strtotime($row['mustBeforeDate']);
     $today = strtotime(date("Y-m-d", time()));
     $difference = $twoWeek - $today;
     $days = floor($difference/(60*60*24));

    $daysArray[$row['reservationId']] = $days;
  }

  // echo $daysArray[5];

  $query = "SELECT * FROM `reservation`,`book`,`user` WHERE book.bookId = reservation.bookId AND reservation.userId = user.userId";
  $result = mysqli_query($link,$query);

  if(isset($_GET['reserveid'])){
    $queryById = "SELECT * FROM `reservation`,`book`,`user` WHERE reservationId=".$_GET['reserveid']." AND book.bookId = reservation.bookId AND reservation.userId = user.userId";
    $resultById = mysqli_query($link,$queryById);
    $rowById = mysqli_fetch_assoc($resultById);
    if($rowById['pricePaid'] >= $rowById['bookPrice']){
      $returnStatus = "1";
        $query = "UPDATE reservation SET returnDate=NOW() WHERE reservationId = ".$_GET['reserveid']." ";
      if(mysqli_query($link,$query)){
        $d = $daysArray[$_GET['reserveid']];
        $nb = $rowById['nbOfBook'] + 1;
        $query = "UPDATE reservation,book SET returnStatus='$returnStatus',nbOfBook='$nb' WHERE reservation.bookId = book.bookId AND reservationId = ".$_GET['reserveid']." ";
        mysqli_query($link,$query);
        $query = "UPDATE reservation SET remaining='".$d."' WHERE reservationId = ".$_GET['reserveid']." ";
        mysqli_query($link,$query);
        $_SESSION['success'] = "Returned Book Successfully.";
        header("location:manageIssueBook.php");
        ob_enf_flush();
      }else{
        $_SESSION['errorr'] = "Error, try it later.";
        header("location:manageIssueBook.php");
        ob_enf_flush();
      }
    }else{
      $_SESSION['errorr'] = "You should pay before submitting.";
      header("location:manageIssueBook.php");
      ob_enf_flush();
    }

  }

 ?>

<script>

  function check(){
    return confirm("Are you sure that the book has been returned?");
  }
</script>


 <div class="container my-5">
   <div class="row">
     <div class="col-md-12">
       <h4>MANAGE ISSUED BOOKS</h4>
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
                 <th scope="col">Student Name</th>
                 <th scope="col">Book Name</th>
                 <th scope="col">ISBN</th>
                 <th scope="col">Remaining</th>
                 <th scope="col">Paid</th>
                 <th scope="col">Pickup Date</th>
                 <th scope="col">Return Date</th>
                 <th scope="col">Status</th>
                 <th scope="col">Action</th>
               </tr>
             </thead>
             <tbody>
               <?php
              $count = 1;
               while($row = mysqli_fetch_assoc($result)) {
                 ?>
                 <tr>
                  <td><?php echo $count ?></td>
                  <td><?php echo $row['firstName']." ".$row['lastName'] ?></td>
                  <td><?php echo $row['bookName'] ?></td>
                  <td><?php echo $row['ISBN'] ?></td>
                  <td><?php if($row['remaining'] == NULL){
                    if(date("Y-m-d") >= $row['pickDate']){
                    if($daysArray[$row['reservationId']]<0){?>
                      <a class="btn btn-danger btn-xs"><?php echo $daysArray[$row['reservationId']]." Days" ?></a>
                  <?php }else{
                    ?><a class="btn btn-success btn-xs"><?php echo $daysArray[$row['reservationId']]." Days" ?></a>
                    <?php
                    }
                  }else{?>
                    <a class="btn btn-danger btn-xs">Not Picked up Yet</a>
                  <?php }
                }else{
                  if($row['remaining']<0){?>
                    <a class="btn btn-danger btn-xs"><?php echo $row['remaining']." Days" ?></a>
                <?php }else{
                  ?><a class="btn btn-success btn-xs"><?php echo $row['remaining']." Days" ?></a>
                  <?php
                  }
                }?></td>
                  <td><?php echo $row['pricePaid']." of ".$row['bookPrice'] ?></td>
                  <td><?php echo $row['pickDate'] ?></td>
                  <td><?php echo $row['mustBeforeDate'] ?></td>
                  <td><?php if($row['returnDate'] == NULL){ ?>
                    <a href="manageIssueBook.php?reserveid=<?php echo $row['reservationId'];?>"><button class="btn btn-dark">Returned?</button></a>
                    <?php  }else{
                    echo $row['returnDate'];
                  } ?></td>
                  <td><a href="editIssueBook.php?rid=<?php echo $row['reservationId'];?>"><button class="btn btn-primary"><i class="fa fa-pencil fa-fw"></i> Edit</button></td>
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
