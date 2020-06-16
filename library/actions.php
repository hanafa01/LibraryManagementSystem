<?php

session_start();

if((array_key_exists("id",$_SESSION) AND $_SESSION['id'])){
  // IMPORTANT!!! if we are in the loginpage, and we direct in the link to sign page.. it will still in the loggedinpage!
  header("Location: admin/dashboard.php");
}

if($_GET['action'] == "logInUserLibrarian"){
  include("views/conn.php");
  $error = "";
  if(!$_POST['email']){
    $error = "An Email Address is required.";
  }else if(!$_POST['password']){
    $error = "An Password is required.";
  }else if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false) {
    $error = "Your email address is not valid.";
  }else{
    if($_POST['loginActive'] == 0){
      $query = "SELECT * FROM `admin` WHERE email = '".mysqli_real_escape_string($link,$_POST['email'])."' AND password = '".mysqli_real_escape_string($link,$_POST['password'])."' LIMIT 1 ";
      $result = mysqli_query($link,$query);
      if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $_SESSION['id'] = $row['id'];
        echo "1";
      }else{
        $error = "Could not find that username/password conbination. Please try it again.";
      }
    }else if($_POST['loginActive'] == 1){
      $query = "SELECT * FROM `user` WHERE email = '".mysqli_real_escape_string($link,$_POST['email'])."' LIMIT 1 ";
      $result = mysqli_query($link,$query);
      if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);

          $hashedPass = $row['password'];
        if (password_verify($_POST['password'], $hashedPass)) {
          if($row['status'] == 0){
            echo "<script>alert('Your Account Has been blocked. Please contact admin');</script>";
          }else{
            $_SESSION['userId'] = $row['userId'];
            echo "2";
          }
        } else {
            $error =  "Invalid password.";
        }
      }else{
        $error = "Could not find that username/password conbination. Please try it again.";
      }
    }
  }

  if($error!=""){
    echo $error;
  }
}

if($_GET['action'] == "addPickDate"){
  if($_POST['pickDate'] != ""){
   include("views/conn.php");
   $queryBook = "SELECT bookId,nbOfBook FROM book WHERE bookId='".$_POST['bookId']."' LIMIT 1";
   if($resultBook = mysqli_query($link,$queryBook)){
     $rowBook = mysqli_fetch_array($resultBook);
     if($rowBook['nbOfBook'] == 0){
       echo "This book is not available right now.";
     }else{
       $q = "SELECT count(userId) as nbOfUserReserved FROM reservation WHERE userId=".$_SESSION['userId']." AND returnStatus = '0'";
       $r = mysqli_query($link,$q);
       $row = mysqli_fetch_assoc($r);
       if($row['nbOfUserReserved'] < 5){
         $query = "INSERT INTO `reservation`(`bookId`, `userId`, `pickDate`, `mustBeforeDate`) VALUES ('".$_POST['bookId']."',".$_SESSION['userId'].",'".$_POST['pickDate']."',DATE_ADD('".$_POST['pickDate']."',INTERVAL 2 WEEK))";
         if(mysqli_query($link,$query)){
             $rowBook['nbOfBook'] = $rowBook['nbOfBook'] - 1;
            $queryUpdate = "UPDATE book SET nbOfBook=".$rowBook['nbOfBook']." WHERE bookId='".$_POST['bookId']."' ";
            if(mysqli_query($link,$queryUpdate)){
               $_SESSION['successs'] = "Book reserved.";
              echo "1";
            }else{
              echo "Error Reserving book, try it later.";
            }
         }else{
           echo "There was error reserve book. Try it later.";
         }
       }else{
         echo "You have maximum books. You must return one or more books.";
       }
     }
   }else{
     echo "There was error reserve book. Try it later.";
   }
  }else{
    echo "Must enter the date.";
  }
}

 ?>
