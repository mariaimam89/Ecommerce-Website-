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
    <link rel="stylesheet" href="partials/style.css">
</head>

<body>


    <?php include 'partials/_header.php';?>

    <?php include 'partials/_dbconnect.php';?>
    <?php
    $id=$_GET['threadid'];
    $sql= "SELECT * FROM `threads` WHERE thread_id=$id";
    $result= mysqli_query($conn, $sql);
    while($row=mysqli_fetch_assoc($result)){
        $title=$row['thread_title'];
        $desc=$row['thread_desc'];
        //fetching the information of the user who have actually asked the question orstared thread
       $user_id=$row['thraed_user_id'];
        $sql2 = "SELECT user_email FROM `users` WHERE sno='$user_id'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $posted_by=$row2['user_email'];
      
        
    }
  ?>


    <!-- INSERT COMMENT IN DATABASE -->
    <?php 
$showAlert=null;
$method=$_SERVER['REQUEST_METHOD'];
if($method=="POST"){


$comment_content=$_POST['comment'];
$user=$_POST['sno'];


    $sql= "INSERT INTO `comments` ( `comment_content`, `thread_id`, `comment_by`, `commrent_time`) VALUES ('$comment_content', '$id', '$user', current_timestamp())";
    $result= mysqli_query($conn, $sql);
    $showAlert=true;
   
}
?>
    <!-- jumbotron -->
    <div class="container jumbotron my-4">
        <br><br><br>
        <?php  if($showAlert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Welldone!</strong> Your Answer have been added!.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    } ?>
        <h1 class="display-4"><?php echo  $title; ?></h1>
        <p class="lead"><?php echo  $desc; ?>
        </p>
        <hr class="my-4">
        <p>
            This is a peer to peer forums, where you can share your knowledge with others.No Spam / Advertising /
            Self-promote in the forums. ...
            Do not post copyright-infringing material. ...
            Do not post “offensive” posts, links or images. ...
            Remain respectful of other members at all times.</p>
        <p>Posted by: <b><?php echo $posted_by; ?></b></p>
    </div>
    <div class="container">



    </div>
    <?php
      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){ 
    echo '
    <div class="container my-4">

        </h1>
        <form action=" '.$_SERVER['REQUEST_URI'].'" method="post">
            <div class="form-group">

                <br>
                <b><label for="comment">Add a Comment</label></b>
                <input type="hidden"  name="sno" value="'.$_SESSION['sno'].'">
                <textarea class="form-control" id="comment" name="comment" rows="4"></textarea>

            </div>
            <br>
            <button type="submit" class="btn btn-primary">POST COMMENT </button>
        </form><br>
    </div>';}
    else{
        echo'<div class="container">
        <h1 class="py-2">Post a Comment</h1> 
           <p class="lead">You are not logged in. Please login to be able to post comments.</p>
        </div>';
    }
    ?>
    <div class="container">
        <h1>
            Discussions
        </h1>
        <br>
        <?php
  $id=$_GET['threadid'];
    $sql= "SELECT * FROM `comments` WHERE thread_id=$id";
    $result= mysqli_query($conn, $sql);
    $noResult=true;
    while($row=mysqli_fetch_assoc($result)){
        $noResult=false;
       

      $ccontent=$row['comment_content'];
      $ccontent = str_replace("<", "&lt;", $ccontent);
      $ccontent = str_replace(">", "&gt;", $ccontent); 
        $comment_time=$row['commrent_time'];
        $thread_user_id=$row['comment_by'];
        $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $user_emial=$row2['user_email'];
      
        echo'
        <div class="media">
        <img src="partials/imgs/userdegault.png" width="60px" height="60px" class="mr-3" alt="...">
        <div class="media-body">
        <h6 class="mt-0 text-dark">'.  $user_emial.' at '.$comment_time.'</h6>
       '.$ccontent.'<br><br>
       </div>
    ';
    }
    if($noResult){
        echo '<div class="jumbotron jumbotron-fluid">
        <div class="container">
          <p class="display-4">No Comments Found</p>
          <p class="lead">Be the First one to respond.</p>
        </div>
      </div>';
    }
  ?>


    </div>

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