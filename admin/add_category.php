<?php
session_start();
include("../database/connection.php");
if($_SERVER['REQUEST_METHOD']=='POST'){
    foreach($_POST as $key => $value) $$key=$value;
    $category=mysqli_real_escape_string($conn,$_POST['category']);
    $check_category_query="SELECT name FROM categories where name='$category'";
    $check_category_query_run=mysqli_query($conn,$check_category_query);
    if(empty($category)){
        $_SESSION['error']="Enter Category Name";
        header("location:admin.php");
    }elseif(empty($image)){
        $_SESSION['error']="Upload Category Image";
        header("location:admin.php");
    }
    elseif(mysqli_num_rows($check_category_query_run)>0){
        $_SESSION['error']="Category Already Exist !";
        header("location:admin.php");
     }else{
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_path = "../uploadsCategory/" . $image_name;
    move_uploaded_file($image_tmp, $image_path);
    $insert_query="INSERT INTO categories (name,image) VALUE ('$category','$image_name')";
    $insert_query_run=mysqli_query($conn,$insert_query);
    header("location:admin.php");
     }
}