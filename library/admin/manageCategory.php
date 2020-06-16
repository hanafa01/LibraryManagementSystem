<?php
ob_start();
include("views/header.php");
include("views/conn.php");

  $query = "SELECT * FROM `category`";
  $result = mysqli_query($link,$query);

  if(isset($_GET['del'])){
    $query = "DELETE FROM `category` WHERE categoryId=".$_GET['del']." ";
    if($result = mysqli_query($link,$query)){
      $_SESSION['success'] = "Deleted Category.";
      header("location:manageCategory.php");
      ob_enf_flush();
    }else{
      $_SESSION['errorr'] = "Error Deleting Category, try it later.";
      header("location:manageCategory.php");
      ob_enf_flush();
    }
  }

 ?>

 <div class="container my-5">
   <div class="row">
     <div class="col-md-12">
       <h4>MANAGE CATEGORY</h4>
       <hr/>
     </div>
   </div>

   <div class="col-md-12">
     <div class="card mb-3" >
       <div class="card-header text-white bg-dark ">Categories Listing</div>
       <div class="card-body">
         <?php if(isset($_SESSION['errorr'])){
           if($_SESSION['errorr'] != ""){?>
           <div class="alert alert-danger"> <?php echo $_SESSION['errorr']; $_SESSION['errorr'] = ""; ?> </div>
         <?php }}?>
          <?php if(isset($_SESSION['success'])){
            if($_SESSION['success'] != ""){?>
            <div class="alert alert-success"> <?php echo $_SESSION['success']; $_SESSION['success'] = ""; ?> </div>
          <?php }}?>

         <div class="table-responsive">
           <table id="dtHorizontalExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
             <thead>
               <tr>
                 <th scope="col">Category Name</th>
                 <th scope="col">Creation Date</th>
                 <th scope="col">Updation Date</th>
                 <th scope="col">Action</th>
               </tr>
             </thead>
             <tbody>
               <?php while($row = mysqli_fetch_assoc($result)) {  ?>
                 <tr>
                  <td><?php echo $row['categoryName'] ?></td>
                  <td><?php echo $row['creationDate'] ?></td>
                  <td><?php echo $row['updationDate'] ?></td>
                    <td class="center">
                      <a href="editCategory.php?categid=<?php echo $row['categoryId']; ?>"><button class="btn btn-primary"><i class="fa fa-pencil fa-fw"></i> Edit</button>
                      <a href="manageCategory.php?del=<?php echo $row['categoryId']; ?>" onclick="return confirm('Are you sure you want to delete?');" ><button class="btn btn-danger"><i class="fa fa-trash-o fa-fw"></i> Delete</button>
                    </td>
                </tr>
          <?php   } ?>
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
       { "searchable": false, "targets": 3 }
     ],
     "columnDefs": [
       { "orderable": false, "targets": 3 }
     ]
   });
 });
</script>
