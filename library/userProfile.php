<?php include('views/header1.php');
include('views/conn.php');

if(isset($_POST['update'])){

$id=$_SESSION['userId'];
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$phone = $_POST['phone'];
$email=$_POST['email'];

$query = "UPDATE `user` SET `firstName`='".mysqli_real_escape_string($link,$fname)."',`lastName`='".mysqli_real_escape_string($link,$lname)."',`mobileNumber`='".mysqli_real_escape_string($link,$phone)."',`email`='".mysqli_real_escape_string($link,$email)."' WHERE userId=".$_SESSION['userId']." ";
mysqli_query($link,$query);

echo '<script>alert("Your profile has been updated")</script>';
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
            <h4>My Profile</h4>
            <hr/>
          </div>
        </div>
        <div class="col-md-6 offset-md-3">
          <div class="card mb-3" >
            <div class="card-header text-white bg-dark ">Change Password</div>
            <div class="card-body">
                  <form name="signup" method="post">
                    <?php
                      $query="SELECT * FROM user where userId=".$_SESSION['userId']." ";
                      $result = mysqli_query($link,$query);
                      $row = mysqli_fetch_assoc($result);
                      ?>
                    <div class="form-group">
                      <label>User ID : </label>
                      <?php echo $row['userId'];?>
                    </div>

                    <div class="form-group">
                      <label>Reg Date : </label>
                      <?php echo $row['registrationDate'];?>
                    </div>
                    <?php if($row['updationDate']!=""){?>
                      <div class="form-group">
                        <label>Last Updation Date : </label>
                        <?php echo $row['updationDate'];?>
                      </div>
                    <?php } ?>
                    <div class="form-group">
                      <label>Profile Status : </label>
                      <?php if($row['status']==1){?>
                      <span style="color: green">Active</span>
                      <?php } else { ?>
                      <span style="color: red">Blocked</span>
                      <?php }?>
                    </div>

                    <div class="form-group">
                      <label>Enter First Name</label>
                      <input class="form-control" type="text" name="fname" value="<?php echo $row['firstName'];?>" autocomplete="off" required />
                    </div>

                    <div class="form-group">
                      <label>Enter Last Name</label>
                      <input class="form-control" type="text" name="lname" value="<?php echo $row['lastName'];?>" autocomplete="off" required />
                    </div>

                    <div class="form-group">
                    <label>Mobile Number :</label>
                    <input class="form-control" type="text" name="phone" maxlength="10" value="<?php echo $row['mobileNumber'];?>" autocomplete="off" required />
                    </div>

                    <div class="form-group">
                    <label>Enter Email</label>
                    <input class="form-control" type="email" name="email" id="emailid" value="<?php echo $row['email'];?>"  autocomplete="off" required readonly />
                    </div>

                    <button type="submit" name="update" class="btn btn-dark text-white" id="submit">Update Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
     <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('views/footer1.php');?>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
