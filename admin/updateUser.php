<?php
session_start();
include("../database/connection.php");

// Check if the form is submitted
if (isset($_POST['update_category'])) {
    // Get the form data
    $id = $_POST['id'];
    $role=$_POST['role'];
    // Update the user record

    $update_query = "UPDATE users SET role='$role' WHERE id = $id";
    mysqli_query($conn, $update_query);

    // Redirect to the user list page

    // Set a success message in the session variable
    $_SESSION['success_message'] = "User updated successfully.";

    // Redirect back to the index.php page
    header("Location: users.php");
    exit();
} else {
    // If the form is not submitted, redirect back to the index.php page
    header("Location: users.php");
    exit();
}
?>