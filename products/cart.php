<?php
include("../admin/navbar.php");
include("../database/connection.php");

if (isset($_GET['id'])) {
    if (isset($_SESSION['auth'])) {
        $email = $_SESSION['auth'];
        $sql = "SELECT name, id FROM users WHERE email='$email'";
        $sql_run = mysqli_query($conn, $sql);

        if ($sql_run && mysqli_num_rows($sql_run) > 0) {
            $row = mysqli_fetch_assoc($sql_run);
            $userName = $row['name'];
            $userId = $row['id'];
        }

        $addId = $_GET['id'];
        $product_sql = "SELECT name, price FROM products WHERE id = '$addId'";
        $product_sql_run = mysqli_query($conn, $product_sql);

        if (mysqli_num_rows($product_sql_run) > 0) {
            $product = mysqli_fetch_assoc($product_sql_run);
            $product_name = $product['name'];
            $product_price = $product['price'];
            $discountedPrice = $product_price - ($product_price * 0.1); // Assuming a 10% discount

            // Check if the user already has a cart
            $cart_sql = "SELECT * FROM cart WHERE user_id = '$userId'";
            $cart_sql_run = mysqli_query($conn, $cart_sql);

          
                // User does not have a cart, create a new cart item
                $add_sql = "INSERT INTO cart (product_id, product_name, user_id, user_name, price)
                            VALUES ('$addId', '$product_name', '$userId', '$userName', '$discountedPrice')";

                if (mysqli_query($conn, $add_sql)) {
                    // Cart item added successfully
                    $_SESSION['addSuccess']=ucwords($product_name)." Added Successfully To The Cart";
                    header("location: category.php");
                } else {
                    // Failed to add item to cart
                    echo "Error: " . mysqli_error($conn);
                }
            
        }
    }
}
?>