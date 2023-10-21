<?php
 include("../admin/navbar.php");
 include("../database/connection.php");

 if(isset($_GET['id'])){
    $delete_Id=$_GET['id'];
    $deleteUser="DELETE FROM users where id='$delete_Id'";
    $deleteUser_run=mysqli_query($conn,$deleteUser);
    $_SESSION['deleteUser']="User with id ". $delete_Id ." Deleted Successfully";
    header("location:users.php");
 }