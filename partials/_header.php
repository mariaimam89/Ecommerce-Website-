<?php
echo '
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">iDiscuss Coding Forum</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/forum">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categories
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact Us</a>
        </li>
      </ul>';
      session_start();
      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
      echo '<form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-primary" type="submit">Search</button>

      </form>
      <p class="text-light my-0 mx-2">Welcome '. $_SESSION['useremail']. '</p>
      <div class="mx-2">
     
      <a href="partials/logout.php" class="btn btn-outline-primary ml-2">Logout</a>
      
      </div>';}
      else echo '<form class="d-flex">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-primary" type="submit">Search</button>

    </form>
 
    <div class="mx-2">
   
      <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
      
      <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>
    </div>';
   echo '</div>
  </div>
</nav>';
include 'partials/loginModal.php';
include 'partials/signupModal.php';
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true"){
  echo '<br><br><div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Welldone!  </strong>  You can now LOGIN into our system!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if(isset($_GET['error'])&& $_GET['signupsuccess']=="false"){
  $error=$_GET['error'];
  echo '<br><br><div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
  <strong>You cannot signup!  </strong>' .$error.'. Please try again!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if(isset($_GET['login']) &&  $_GET['login']=="false"){
  $error=$_GET['loginerror'];
  echo '<br><br><div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
  <strong>' .$error.'  </strong>. Please try again!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

?>