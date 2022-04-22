<?php
$showError="false";
if($_SERVER['REQUEST_METHOD']=="POST"){
    include('_dbconnect.php');
    $user_email=$_POST['loginEmail'];
    $pass=$_POST['loginPass'];
   
//check whether this email exists
$sql="select * from `users` where user_email='$user_email'";
$result=mysqli_query($conn, $sql);
$numrow=mysqli_num_rows($result);
if($numrow==1){
$row=mysqli_fetch_assoc($result);
if(password_verify($pass, $row['user_password'])){
    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['sno'] = $row['sno'];
    $_SESSION['useremail'] = $user_email;
    echo "logged in ". $user_email;
    header("Location: /forum/index.php"); 
    exit();
}
else{
    $error="Unable to login, password Donot match.";
    


}
header("Location: /forum/index.php?login=false&&loginerror=$error");
}

}




?>