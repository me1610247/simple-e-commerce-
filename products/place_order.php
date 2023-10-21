<?php
include("../admin/navbar.php");
include("../database/connection.php");

if (isset($_SESSION['auth'])) {
    $email = $_SESSION['auth'];
    $sql = "SELECT * FROM users WHERE email='$email'";
    $sql_run = mysqli_query($conn, $sql);

    if ($sql_run && mysqli_num_rows($sql_run) > 0) {
        $row = mysqli_fetch_assoc($sql_run);
        $userId = $row['id'];
        $userPhone = $row['phone'];
        $userAddress = $row['address'];

        // Insert order details into the 'orders' table
        $totalPrice = $_POST['total_price'];
        $order_sql = "INSERT INTO orders (user_id, user_phone, user_address, total_price) 
                      VALUES ('$userId', '$userPhone', '$userAddress', '$totalPrice')";
        mysqli_query($conn, $order_sql);
        
        // Get the order ID of the inserted order

        // Get the cart items for the user
        $cart_items_sql = "SELECT * FROM cart WHERE user_id = '$userId'";
        $cart_items_result = mysqli_query($conn, $cart_items_sql);

        if (mysqli_num_rows($cart_items_result) > 0) {
            // Create an array to store the cart items
            $cart_items = array();

            // Iterate through the cart items and add them to the array
            while ($cart_item = mysqli_fetch_assoc($cart_items_result)) {
                $product_name = $cart_item['product_name'];
                $product_id = $cart_item['product_id'];
                $user_id = $userId;

                $cart_items[] = "('$product_id','$product_name','$user_id')";
            }

            // Insert all cart items in one query to the 'order_items' table
            $insert_items_sql = "INSERT INTO order_items (product_id,product_name,user_id) 
                                 VALUES " . implode(",", $cart_items);
            mysqli_query($conn, $insert_items_sql);

            // Empty the cart after placing the order
            $delete_cart_sql = "DELETE FROM cart WHERE user_id = '$userId'";
            mysqli_query($conn, $delete_cart_sql);

            // Redirect to a success page or display a success message
            $_SESSION['order'] = "Order Placed Successfully";
            header("Location: category.php");
            exit();
        } else {
            // No items in the cart
            $_SESSION['order'] = "No items in the cart.";
            header("Location: category.php");
            exit();
        }
    }
} else {
    // User is not logged in
    $_SESSION['order'] = "Please log in to place an order.";
    header("Location: category.php");
    exit();
}
?>