<?php
include("views/header.php");
include("views/conn.php");

$query = "SELECT *,DATE_FORMAT(pickDate, '%Y-%m-%d') as getDate FROM `reservation`,`book`,`user` WHERE DATE(pickDate) = CURDATE() AND book.bookId = reservation.bookId AND reservation.userId = user.userId";
$result = mysqli_query($link,$query);

$queryReturn = "SELECT *,DATE_FORMAT(mustBeforeDate, '%Y-%m-%d') as getDate FROM `reservation`,`book`,`user` WHERE DATE(mustBeforeDate) = CURDATE() AND book.bookId = reservation.bookId AND reservation.userId = user.userId";
$resultReturn = mysqli_query($link,$queryReturn);
?>

     <div class="container my-5">
    <div class="row pad-botm">
        <div class="col-md-12">
            <h4>ADMIN DASHBOARD</h4>
            <hr/>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-6 col-sm-12 col-xs-12">
          <h4>Book(s) that should be Picked Up Today:</h4>
          <div class="table-responsive">
            <table id="dtHorizontalExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">ISBN</th>
                  <th scope="col">Book Name</th>
                  <th scope="col">Full Name</th>
                  <th scope="col">Paid</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if(mysqli_num_rows($result) == 0){?>
                  <tr>
                    <td colspan="5" class="text-danger" style="text-align: center">No book item available.</td>
                  </tr>
                <?php }else{
               $count = 1;
                while($row = mysqli_fetch_assoc($result)) {
                  ?>
                  <tr>
                   <td><?php echo $count ?></td>
                   <td><?php echo $row['ISBN'] ?></td>
                   <td><?php echo $row['bookName'] ?></td>
                   <td><?php echo $row['firstName']." ".$row['lastName'] ?></td>
                   <td><?php echo $row['pricePaid']." of ".$row['bookPrice'] ?></td>
                 </tr>
           <?php
           $count++;
             }
           }?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12">
          <h4>Book(s) that should be Returned Today:</h4>
          <div class="table-responsive">
            <table id="dtHorizontalExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">ISBN</th>
                  <th scope="col">Book Name</th>
                  <th scope="col">Full Name</th>
                  <th scope="col">Paid</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if(mysqli_num_rows($resultReturn) == 0){?>
                  <tr>
                    <td colspan="5" class="text-danger" style="text-align: center">No book item available.</td>
                  </tr>
                <?php }else{
               $count = 1;
                while($row = mysqli_fetch_assoc($resultReturn)) {
                  ?>
                  <tr>
                   <td><?php echo $count ?></td>
                   <td><?php echo $row['ISBN'] ?></td>
                   <td><?php echo $row['bookName'] ?></td>
                   <td><?php echo $row['firstName']." ".$row['lastName'] ?></td>
                   <td><?php echo $row['pricePaid']." of ".$row['bookPrice'] ?></td>
                 </tr>
           <?php
           $count++;
             }
           }?>
              </tbody>
            </table>
          </div>
        </div>
    </div>

<hr/>

         <div class="row">
          <div class="col-md-3 col-sm-3 col-xs-6">
              <div class="alert alert-success back-widget-set text-center">
                  <i class="fa fa-book fa-5x"></i>
                  <?php $query = "SELECT count(bookId) as count FROM book";
                        $result = mysqli_query($link,$query);
                        $row = mysqli_fetch_assoc($result);?>
                    <h3><?php echo $row['count'] ?></h3>
                      Books Listed.
              </div>
          </div>

          <div class="col-md-3 col-sm-3 col-xs-6">
              <div class="alert alert-info back-widget-set text-center">
                  <i class="fa fa-bars fa-5x"></i>
                  <?php $query = "SELECT count(reservationId) as count FROM reservation";
                        $result = mysqli_query($link,$query);
                        $row = mysqli_fetch_assoc($result);?>
                    <h3><?php echo $row['count'] ?></h3>
                       Times Book Issued.
              </div>
          </div>

           <div class="col-md-3 col-sm-3 col-xs-6">
              <div class="alert alert-warning back-widget-set text-center">
                  <i class="fa fa-recycle fa-5x"></i>
                  <?php $query = "SELECT count(reservationId) as count FROM reservation WHERE returnStatus='1' ";
                        $result = mysqli_query($link,$query);
                        $row = mysqli_fetch_assoc($result);?>
                    <h3><?php echo $row['count'] ?></h3>
                      Times  Books Returned.
              </div>
          </div>

           <div class="col-md-3 col-sm-3 col-xs-6">
              <div class="alert alert-danger back-widget-set text-center">
                  <i class="fa fa-users fa-5x"></i>
                  <?php $query = "SELECT count(userId) as count FROM user";
                        $result = mysqli_query($link,$query);
                        $row = mysqli_fetch_assoc($result);?>
                    <h3><?php echo $row['count'] ?></h3>
                      Registered Users.
              </div>
          </div>

        </div>



        <div class="row">

          <div class="col-md-3 col-sm-3 col-xs-6">
              <div class="alert alert-success back-widget-set text-center">
                  <i class="fa fa-user fa-5x"></i>
                  <?php $query = "SELECT count(authorId) as count FROM author";
                        $result = mysqli_query($link,$query);
                        $row = mysqli_fetch_assoc($result);?>
                    <h3><?php echo $row['count'] ?></h3>
                      Authors Listed.
              </div>
          </div>


          <div class="col-md-3 col-sm-3 rscol-xs-6">
            <div class="alert alert-info back-widget-set text-center">
                <i class="fa fa-file-archive-o fa-5x"></i>
                <?php $query = "SELECT count(categoryId) as count FROM category";
                      $result = mysqli_query($link,$query);
                      $row = mysqli_fetch_assoc($result);?>
                  <h3><?php echo $row['count'] ?></h3>
                    Listed Categories.
            </div>
          </div>
        </div>
      </div>

<?php
include("views/footer.php");
 ?>
