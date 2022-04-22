<?php
$showError="false";
if($_SERVER['REQUEST_METHOD']=="POST"){
    include('_dbconnect.php');
    $user_email=$_POST['signupemail'];
    $pass=$_POST['signuppass'];
    $cpass=$_POST['signupcpass'];
//check whether this email exists
$sql="select * from `users` where user_email='$user_email'";
$result=mysqli_query($conn, $sql);
$numrow=mysqli_num_rows($result);
if($numrow>0){
    $showError="email is alreday in use";
    
}
else if($pass==$cpass){
$hash=password_hash($pass, PASSWORD_DEFAULT);
$query="INSERT INTO `users` (`user_email`, `user_password`, `timestamp`) VALUES ('$user_email', '$hash', current_timestamp());";
$result=mysqli_query($conn, $query);
if($result){
    $showAlert=true;
    header("Location: /forum/index.php?signupsuccess=true");
    exit();
}
}
else{
    $showError="password donot match";
}
header("Location: /forum/index.php?signupsuccess=false&&error=$showError");
}




?>