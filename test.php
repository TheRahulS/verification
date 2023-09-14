<?php
 
include 'connection.php';

    $token=$_GET['code'];
    $sql="update signup set status='active' where token='$token'";
  

$result=mysqli_query($conn,$sql);
if($result){
    
    header("Location:Login.php");
}

?>