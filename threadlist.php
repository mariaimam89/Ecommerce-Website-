<?php include 'partials/_dbconnect.php';?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Welcome to iDiscuss</title>
</head>

<body>


    <?php include 'partials/_header.php';?>

 
    <?php
  $cat_id=$_GET['catid'];
    $sql= "SELECT * FROM `categories` WHERE category_id=$cat_id";
    $result= mysqli_query($conn, $sql);
    while($row=mysqli_fetch_assoc($result)){
        $catname=$row['category_name'];
        $catdesc=$row['category_description'];
    }
  ?>
<!-- INSERT THREAD IN DATABASE -->
   
<?php 
$showAlert=null;
$method=$_SERVER['REQUEST_METHOD'];
if($method=="POST"){

$thtitle=$_POST['thread_title'];
$thdesc=$_POST['thread_desc'];
$thtitle = str_replace("<", "&lt;", $thtitle);
$thtitle = str_replace(">", "&gt;", $thtitle); 

$thdesc = str_replace("<", "&lt;", $thdesc);
$thdesc = str_replace(">", "&gt;", $thdesc); 
$thuser=$_POST['sno'];


    $sql= "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_category_id`, `thraed_user_id`) VALUES ('$thtitle', '$thdesc', '$cat_id', '$thuser')";
    $result= mysqli_query($conn, $sql);
    $showAlert=true;
   
}
?>
 <!-- jumbotron -->
    <div class="container jumbotron my-4">
        <br><br><br>
        <?php  if($showAlert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Welldone!</strong> Your thread has been added successfully, wait for our comunity to respond.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    } ?>
        <h1 class="display-4">Welcome to <?php echo $catname; ?> forums!</h1>
        <p class="lead"><?php echo $catdesc; ?>
        </p>
        <hr class="my-4">
        <p>
            This is a peer to peer forums, where you can share your knowledge with others.No Spam / Advertising /
            Self-promote in the forums. ...
            Do not post copyright-infringing material. ...
            Do not post “offensive” posts, links or images. ...
            Remain respectful of other members at all times.</p>
      
        <p class="lead">

        </p>
    </div>
    <?php
      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){ 
    echo '<div class="container">
        <!-- question form -->
        <h1>
            Ask a Question
        </h1>
        <form action="'.$_SERVER["REQUEST_URI"].'" method="post">
            <div class="form-group">
               <b> <label for="thread_title">Question Title</label></b>
                <input type="test" class="form-control" id="thread_title" name="thread_title"
                    aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">Keep your Question title as short and crisp as
                    possible!</small>
                    <input type="hidden"  name="sno" value="'.$_SESSION['sno'].'">
                    <br>
                <b><label for="thread_desc">Elaborate your problem</label></b>
                <textarea class="form-control" id="thread_desc" name="thread_desc" rows="4"></textarea>

            </div>
<br>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>';}
    else{
        echo '<div class="container">
        <h1 class="py-2">Start a Discussion</h1> 
           <p class="lead">You are not logged in. Please login to be able to start a Discussion</p>
        </div>';
    }
    ?>
    <div class="container my-4">
        <h1>
            Browse Questions
        </h1>
        <?php
  $cat_id=$_GET['catid'];
    $sql= "SELECT * FROM `threads` WHERE thread_category_id=$cat_id";
    $result= mysqli_query($conn, $sql);
    $noResult=true;
    while($row=mysqli_fetch_assoc($result)){
        $noResult=false;
        $tid=$row['thread_id'];
        $ttitle=$row['thread_title'];
        $tdesc=$row['thread_desc'];
        $comment_time=$row['thread_time'];
        $thread_user_id=$row['thraed_user_id'];
        $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $user_emial=$row2['user_email'];
        echo'
        <div class="media">
        <img src="partials/imgs/userdegault.png" width="60px" height="60px" class="mr-3" alt="...">
      
        <h5 class="mt-0 text-dark"><a href="threads.php?threadid='.$tid.'">'.$ttitle.'<a></h5>
       '.$tdesc.'  <h6 class="mt-0 text-dark"> Asked by: '.$user_emial.' at '.$comment_time.'</h6>
    </div>';
    }
    if($noResult){
        echo '<div class="jumbotron jumbotron-fluid">
        <div class="container">
          <p class="display-4">No Threads Found</p>
          <p class="lead">Be the First one to ask the question.</p>
        </div>
      </div>';
    }
  ?>

<br><br><br>   
<?php include 'partials/footer.php';?>
        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->

</body>

</html>