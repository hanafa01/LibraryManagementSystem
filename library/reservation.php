<?php
ob_start();
include("views/header1.php");
include("views/conn.php");

$query = "SELECT * FROM `reservation` WHERE userId =".$_SESSION['userId']." ";
$result = mysqli_query($link,$query);
while($row = mysqli_fetch_assoc($result)){
  $twoWeek = strtotime($row['mustBeforeDate']);
   $today = strtotime(date("Y-m-d", time()));
   $difference = $twoWeek - $today;
   $days = floor($difference/(60*60*24));

  $daysArray[$row['reservationId']] = $days;
}

  $query = "SELECT * FROM `reservation`,`book`,`user` WHERE reservation.userId =".$_SESSION['userId']." AND book.bookId = reservation.bookId AND reservation.userId = user.userId";
  $result = mysqli_query($link,$query);

 ?>

 <div class="container my-5">
   <div class="row">
     <div class="col-md-12">
       <h4>YOUR RESERVATION</h4>
       <hr/>
     </div>
   </div>

   <div class="col-md-12">

         <?php if(isset($_SESSION['errorr'])){
           if($_SESSION['errorr'] != ""){?>
           <div class="alert alert-danger"> <?php echo $_SESSION['errorr']; $_SESSION['errorr'] = ""; ?> </div>
         <?php }}?>
          <?php if(isset($_SESSION['successs'])){
            if($_SESSION['successs'] != ""){?>
            <div class="alert alert-success"> <?php echo $_SESSION['successs']; $_SESSION['successs'] = ""; ?> </div>
          <?php }}?>

         <div class="table-responsive">
            <table id="book_table" class="table table-striped table-bordered table-sm"  width="100%">
             <thead>
               <tr>
                 <th scope="col">#</th>
                 <th scope="col">Book Name</th>
                 <th scope="col">ISBN</th>
                 <th scope="col">Remaining</th>
                 <th scope="col">Paid</th>
                 <th scope="col">Pickup Date</th>
                 <th scope="col">Return Date</th>
                 <th scope="col">Status</th>
               </tr>
             </thead>
             <tbody>
               <?php
              $count = 1;
               while($row = mysqli_fetch_assoc($result)) {
                 ?>
                 <tr>
                  <td><?php echo $count ?></td>
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
                  <td><?php
                  $yourDateTime = $row['pickDate'];
                  echo date('Y-m-d', strtotime($yourDateTime));
                  ?></td>
                  <td><?php
                  $yourDateTime = $row['mustBeforeDate'];
                  echo date('Y-m-d', strtotime($yourDateTime));
                  ?></td>
                  <td><?php if($row['returnDate'] == NULL){ ?>
                    <button class="btn btn-dark">NOT RETURNED</button>
                    <?php  }else{
                    echo $row['returnDate'];
                  } ?></td>
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
 });
</script>
