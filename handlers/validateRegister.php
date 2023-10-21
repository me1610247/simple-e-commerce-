<?php
session_start();
include ("../database/connection.php");
include ("../functions/validations.php");
if($_SERVER['REQUEST_METHOD']=='POST'){
    foreach($_POST as $key => $value) $$key=sanitizeInput($value);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $check_email_query="SELECT email FROM users where email='$email'";
    $check_email_query_run=mysqli_query($conn,$check_email_query);
if(empty($username)){
    $_SESSION['error']="Username Can not be empty";
    header("location:../register.php");
}
elseif(empty($email)){
    $_SESSION['error']="Email Can not be empty";
    header("location:../register.php");
}
elseif(empty($phone)){
    $_SESSION['error']="Phone Can not be empty";
    header("location:../register.php");
}
elseif(empty($address)){
    $_SESSION['error']="Address Can not be empty";
    header("location:../register.php");
}
elseif(empty($password)){
    $_SESSION['error']="Password Can not be empty";
    header("location:../register.php");
}
elseif(empty($confirmpassword)){
    $_SESSION['error']="Password Can not be empty";
    header("location:../register.php");
}
elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    $_SESSION['error']="Email is not valid";
    header("location:../register.php");
}
elseif($password!=$confirmpassword){
    $_SESSION['error']="Password does not match";
    header("location:../register.php");
}
elseif(mysqli_num_rows($check_email_query_run)>0){
    $_SESSION['error']="Email Already Exist ! , Try Another one";
    header("location:../register.php"); }  
else{
    $insert_query="INSERT INTO users (name,email,password,phone,address)
    VALUES ('$username','$email','$password','$phone','$address')";
    $insert_query_run=mysqli_query($conn,$insert_query);
    $register_query="SELECT * FROM users WHERE email='$email' and name='$username' and phone= '$phone'";
    $register_query_run=mysqli_query($conn,$register_query);
    $dataUser=mysqli_fetch_array($register_query_run);
    $email=$dataUser['email'];
    $_SESSION['auth']=$email;
    if($insert_query_run){
        header("location:../products/category.php");
    }else{
        $_SESSION['error']="Something went wrong";
        header("location:../register.php");
    }
}
}