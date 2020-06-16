
<?php session_start();

if((!array_key_exists("id",$_SESSION) AND !$_SESSION['id'])){
  header("Location: ../index.php");
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css"/>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <title>Online Library Management System</title>
  </head>
  <body>
    <div class="navbar navbar-inverse set-radius-zero" >
        <div class="container">
            <div class="navbar-header">
              <a class="navbar-brand" >
                <img class="logo" src="views/logo.png" />
              </a>
            </div>
            <div class="right-div">
              <?php
              // if(isset($_SESSION['id'])){
              //   echo $_SESSION['id'];
              // }else{
              //   echo "there is not";
              // }

               ?>
                <a href="logout.php" class="btn btn-danger pull-right fa fa-sign-out fa-fg"></a>
            </div>
        </div>
    </div>
    <section class="menu-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
              <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" ></span>
              </button>
              <div class="collapse navbar-collapse ml-auto" id="navbarNavDropdown">
                <ul  class=" navbar-nav ml-auto">
                  <li class="nav-item active">
                    <a class="nav-link" href="dashboard.php">DASHBOARD</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      CATEGORIES
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      <a class="dropdown-item" href="addCategory.php">ADD CATEGORY</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="manageCategory.php">MANAGE CATEGORY</a>
                    </div>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      AUTHORS
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink1">
                      <a class="dropdown-item" href="addAuthor.php">ADD AUTHOR</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="manageAuthor.php">MANAGE AUTHORS</a>
                    </div>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      BOOKS
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
                      <a class="dropdown-item" href="addBook.php">ADD BOOK</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="manageBook.php">MANAGE BOOKS</a>
                    </div>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      ISSUE BOOKS
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink3">
                      <a class="dropdown-item" href="issueBook.php">ISSUE NEW BOOK</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="manageIssueBook.php">MANAGE ISSUED BOOKS</a>
                    </div>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="viewUsers.php">VIEW USERS</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="changePassword.php">CHANGE PASSWORD</a>
                  </li>
                </ul>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </section>
