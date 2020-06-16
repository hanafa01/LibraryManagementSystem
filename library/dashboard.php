<?php
include("views/header1.php");
include("views/conn.php");
?>

     <div class="container">
    <div class="row pad-botm">
        <div class="col-md-12">
            <h4>ADMIN DASHBOARD</h4>
            <hr/>
        </div>
    </div>

         <div class="row">

          <div class="col-md-3 col-sm-3 col-xs-6">
              <div class="alert alert-info back-widget-set text-center">
                  <i class="fa fa-bars fa-5x"></i>

                  <?php
                        $returnStatus = "0";
                        $query = "SELECT count(reservationId) as count FROM reservation WHERE userId=".$_SESSION['userId']." AND returnStatus='$returnStatus' ";
                        $result = mysqli_query($link,$query);
                        $row = mysqli_fetch_assoc($result);?>
                    <h3><?php echo $row['count'] ?></h3>
                       Book(s) Reserved.
              </div>
          </div>

           <div class="col-md-3 col-sm-3 col-xs-6">
              <div class="alert alert-warning back-widget-set text-center">
                  <i class="fa fa-recycle fa-5x"></i>
                  <?php $query = "SELECT count(reservationId) as count FROM reservation WHERE returnStatus='1' AND userId=".$_SESSION['userId']."";
                        $result = mysqli_query($link,$query);
                        $row = mysqli_fetch_assoc($result);?>
                    <h3><?php echo $row['count'] ?></h3>
                      Book(s) Returned.
              </div>
          </div>
        </div>
      </div>

<?php
include("views/footer1.php");
 ?>
