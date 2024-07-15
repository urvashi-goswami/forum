<?php
session_start();

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<a class="navbar-brand" href="/forum">iDiscuss</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item active">
      <a class="nav-link" href="/Project/forum/index.php">Home <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/Project/forum/about.php">About</a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Top Categories
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">';
      
      $sql = "SELECT `category_name`,`category_id` FROM `category` WHERE `category_id` LIMIT 3";
      $result = mysqli_query($con,$sql);
      while ($row = mysqli_fetch_assoc($result)) {
        echo '<a class="dropdown-item" href="threads_list.php?catid='.$row['category_id'].'"> '.$row['category_name'].'</a>';
      }
      
    echo ' </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/Project/forum/contact.php" >Contact</a>
    </li>
  </ul>
  <div class="row mx-2">';

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        echo '<form class="form-inline my-2 my-lg-0" method="get" action="search.php">
        <input class="form-control mr-sm-2" name="search" type="search" actiion="search.php" placeholder="Search" aria-label="Search">
        <button class="btn btn-info my-2 my-sm-0" type="submit">Search</button>
          <p class="text-light my-0 mx-2">Welcome '.$_SESSION['username'].' </p>
          <a href="/Project/Forum/partial/_logout.php" class="btn btn-outline-info ml-2">Logout</a>
          </form>';
    } else {
        echo '<form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-info my-2 my-sm-0" type="submit">Search</button>
        </form>
        <div class="btn-group ml-2" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#loginModal">Login</button>
            <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#signupModal">Signup</button>
        </div>';
    }
echo '</div>
      </div>
      </nav>';

include 'partial/_login_modal.php';
include 'partial/_signup_modal.php';

if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true") {

  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
            <strong>Success!</strong> You are Login Successfully.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>';
  }
  else{
    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
            <strong>Success!</strong> You can now login.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>';
  }
}

if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "false") {
    echo '<div class="alert alert-warning alert-dismissible my-0 fade show" role="alert">
    <strong>Warning!</strong> ' . $_GET['error'] . '
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>';
}

?>