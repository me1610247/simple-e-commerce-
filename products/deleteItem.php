<?php
session_start();
include("../database/connection.php");
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $sql="SELECT * FROM cart where id='$id'";
        $sql_run=mysqli_query($conn,$sql);
        if (mysqli_num_rows($sql_run) > 0) {
            $cartItem = mysqli_fetch_assoc($sql_run);
            $category_name = $cartItem['product_name'];
        }
        $delete_query="DELETE FROM cart WHERE id ='$id'";
       $delete_query_run=mysqli_query($conn,$delete_query);
       $_SESSION['deleteItem']=ucwords($category_name)." Item Deleted Successfully";
       header("location:viewcart.php");
    }