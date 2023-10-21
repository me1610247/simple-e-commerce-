<?php
session_start();
include("../database/connection.php");
if($_SERVER['REQUEST_METHOD']=='POST'){
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);
    $login_query="SELECT * FROM users where email ='$email' AND password ='$password'";
    $login_query_run=mysqli_query($conn,$login_query);
    if(mysqli_num_rows($login_query_run)>0){
        $userData=mysqli_fetch_array($login_query_run);
        $email=$userData['email'];
        $_SESSION['auth']=$email;
        header("location:../products/category.php");
    }else{
        $_SESSION['error']="Invalid Email or Password";
        header("location:../index.php");
    }
}