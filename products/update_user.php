<?php
session_start();
include("../database/connection.php");

// Check if the form is submitted
if (isset($_POST['update_user'])) {
    // Get the form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    // Update the user record
    if(empty($name)){
        $_SESSION['error']="Enter a Name Please";
        header("location:editAddress.php");
    }
    elseif(empty($phone)){
        $_SESSION['error']="Enter a phone Please";
        header("location:editAddress.php");
    }
    elseif(empty($address)){
        $_SESSION['error']="Enter a Address Please";
        header("location:editAddress.php");
    }else{

    $update_query = "UPDATE users SET  name = '$name',phone = '$phone',address =' $address' WHERE id = $id";
    mysqli_query($conn, $update_query);

    // Redirect to the user list page

    // Set a success message in the session variable
    $_SESSION['success_message'] = "category updated successfully.";

    // Redirect back to the index.php page
    header("Location: editAddress.php");
    }
    exit();
} else {
    // If the form is not submitted, redirect back to the index.php page
    header("Location: editAddress.php");
    exit();
}
?>