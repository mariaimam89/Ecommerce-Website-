<?php
 $servername = "localhost";
 $username = "root";
 $password = "";
 $database = "idiscuss";

 $conn= mysqli_connect($servername, $username, $password, $database);

 //die if we fail to connect
 if(!$conn){
     die("sorry we failed to connect".mysqli_connect_error());
 }
 
 
?>