<?php
include("views/conn.php");
$output = '';
$order = $_POST['order'];
if($order == 'desc'){
  $order = 'asc';
}else{
  $order = 'desc';
}
$query = "SELECT * FROM book ORDER BY ".$_POST['column_name']." ".$_POST['order']." ";
$result = mysqli_query($link,$query);
echo "tyrtgedgted";
$output.= '
<table id="book_table" class="table table-striped table-bordered table-sm" cellspacing="0"
width="100%">
 <thead>
   <tr>
     <th scope="col"><a class="column_sort" id="id" data-order="'.$order.'" href="#">ID</a></th>
     <th scope="col"><a class="column_sort" id="bookName" data-order="'.$order.'" href="#">Book Name</a></th>
     <th scope="col"><a class="column_sort" id="categoryName" data-order="'.$order.'" href="#">Category Name</a></th>
     <th scope="col"><a class="column_sort" id="authorName" data-order="'.$order.'" href="#">Author Name</a></th>
     <th scope="col"><a class="column_sort" id="publisherName" data-order="'.$order.'" href="#">Publisher Name</a></th>
     <th scope="col"><a class="column_sort" id="publicationYear" data-order="'.$order.'" href="#">Publication Year</a></th>
     <th scope="col"><a class="column_sort" id="price" data-order="'.$order.'" href="#">Price</a></th>
     <th scope="col">Nb Of Book</th>
     <th scope="col">Status</th>
     <th scope="col">Action</th>
   </tr>
   </thead>';
   while($row=mysqli_fetch_array($result)){
     $output .= '<tr>
      <td scope="row"><?php echo $row["id"] ?></td>
      <td><?php echo $row["bookName"] ?></td>
      <td><?php echo $row["categoryName"] ?></td>
      <td><?php echo $row["authorName"] ?></td>
      <td><?php echo $row["publisherName"] ?></td>
      <td><?php echo $row["publicationYear"] ?></td>
      <td><?php echo $row["bookPrice"] ?></td>
      <td><?php echo $row["nbOfBook"]; ?></td>
      <td><?php if($row["status"] == 1) {?>
                          <a href="#" class="btn btn-success btn-xs">Active</a>
          <?php } else {?>
                          <a href="#" class="btn btn-danger btn-xs">Inactive</a>
                  <?php } ?></td>
      <td>
        <a href="editBook.php?bookid=<?php echo $row["bookId"];?>"><button class="btn btn-primary"><i class="fa fa-pencil fa-fw"></i> Edit</button>
        <a href="manageBook.php?del=<?php echo $row["bookId"]; ?>" onclick="return confirm('Are you sure you want to delete?');" ><button class="btn btn-danger"><i class="fa fa-trash-o fa-fw"></i> Delete</button>
      </td>
    </tr>';
   }

?>
