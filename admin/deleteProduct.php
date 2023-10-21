<?php
session_start();
include("../database/connection.php");

if(isset($_GET['id'])){
    $delete_Id=$_GET['id'];
    $deleteProduct="DELETE FROM products where id='$delete_Id'";
    $deleteProduct_run=mysqli_query($conn,$deleteProduct);
    $_SESSION['delete']="Item Deleted Successfully";
    header("location:products.php");
}