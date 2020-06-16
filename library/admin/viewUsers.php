<?php
ob_start();
include("views/header.php");
include("views/conn.php");

$query = "SELECT * FROM `user`";
$result = mysqli_query($link,$query);

if(isset($_GET['id'])){
$id=$_GET['id'];
$status=1;
$sql = "update user set status=$status WHERE userId=$id";
mysqli_query($link,$sql);
header('location:viewUsers.php');
}

if(isset($_GET['inid'])){
$id=$_GET['inid'];
$status=0;
$sql = "update user set status=$status WHERE userId=$id";
mysqli_query($link,$sql);
header('location:viewUsers.php');
}

 ?>

 <div class="container my-5">
   <div class="row">
     <div class="col-md-12">
       <h4>VIEW USERS</h4>
       <hr/>
     </div>
   </div>

   <div class="col-md-12">
     <div class="card mb-3" >
       <div class="card-header text-white bg-dark ">Users Listing</div>
       <div class="card-body">
         <div class="table-responsive">
           <table id="book_table" class="table table-striped table-bordered table-sm" width="100%">
             <thead>
               <tr>
                 <th scope="col">#</th>
                 <th scope="col">StudentID</th>
                 <th scope="col">First Name</th>
                 <th scope="col">Last Name</th>
                 <th scope="col">Mobile Number</th>
                 <th scope="col">Email</th>
                 <th scope="col">Registration Date</th>
                 <th scope="col">Status</th>
                 <th scope="col">Action</th>
               </tr>
             </thead>
             <tbody>

               <?php
               $count = 1;
               while($row = mysqli_fetch_assoc($result)) {  ?>
                 <tr>
                  <td><?php echo $count ?></td>
                  <td><?php echo $row['userId'] ?></td>
                  <td><?php echo $row['firstName'] ?></td>
                  <td><?php echo $row['lastName'] ?></td>
                  <td><?php echo $row['mobileNumber'] ?></td>
                  <td><?php echo $row['email'] ?></td>
                  <td><?php echo $row['registrationDate'] ?></td>
                  <td class="center"><?php if($row['status'] == 1){
                    echo htmlentities("Active");
                    } else {
                    echo htmlentities("Blocked");
                    }
                    ?></td>
                  <td class="center">
                    <?php if($row['status'] == 1){?>
                      <a href="viewUsers.php?inid=<?php echo htmlentities($row['userId']);?>" onclick="return confirm('Are you sure you want to block this user?');">  <button class="btn btn-danger"> Inactive</button>
                <?php } else {?>
                      <a href="viewUsers.php?id=<?php echo htmlentities($row['userId']);?>" onclick="return confirm('Are you sure you want to active this user?');"><button class="btn btn-primary"> Active</button>
                      <?php } ?>
                    </td>
                </tr>
          <?php $count++;
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
     "lengthMenu": [5,10,15,20,25,30,35,40,45,50],
     "columnDefs": [
       { "searchable": false, "targets": 8 }
     ],
     "columnDefs": [
       { "orderable": false, "targets": 8 }
     ]
   });
 });
</script>
