<?php
session_start(); // Start the session

include("database/connection.php");

if(isset($_GET['id'])) {
    $cartId = $_GET['id'];

    // Retrieve product information
    $product_id = "SELECT * FROM products WHERE id='$cartId'";
    $product_result = mysqli_query($conn, $product_id);
    $product = mysqli_fetch_assoc($product_result);
    $product_name=$product['name'];
    
    if($product) { // Check if the product exists
        if(isset($_SESSION['auth'])) {
            $email = $_SESSION['auth'];

            // Retrieve user information
            $query = "SELECT name, id FROM users WHERE email = '$email'";
            $query_run = mysqli_query($conn, $query);

            if($query_run && mysqli_num_rows($query_run) > 0) {
                $row = mysqli_fetch_assoc($query_run);
                $userName = $row['name'];
                $userId = $row['id'];

                // Insert the cart item into the cart table
                $cart_query = "INSERT INTO cart (product_id,product_name,user_id, user_name) VALUES ('$cartId','$product_name','$userId', '$userName')";
                mysqli_query($conn, $cart_query);
                header("location:cart.php");
            }
        }
    }
}
?>