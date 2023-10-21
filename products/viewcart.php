<?php
include("../admin/navbar.php");
include("../database/connection.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cart</title>
    <style>
        /* CSS styling code here */
    </style>
</head>
<body>
    <?php
    if (isset($_SESSION['deleteItem'])) {
        ?>
        <div class="delete message">
            <?= $_SESSION['deleteItem'] ?>;
        </div>
        <?php
    }
    unset($_SESSION['deleteItem']);
    ?>

    <div class="container">
        <div class="cart-container">
            <?php
            $totalPrice = 0; // Initialize total price variable

            if (isset($_SESSION['auth'])) {
                $email = $_SESSION['auth'];
                $sql = "SELECT id FROM users WHERE email='$email'";
                $sql_run = mysqli_query($conn, $sql);

                if ($sql_run && mysqli_num_rows($sql_run) > 0) {
                    $row = mysqli_fetch_assoc($sql_run);
                    $userId = $row['id'];

                    // Get the cart items for the user
                    $cart_sql = "SELECT * FROM cart WHERE user_id = '$userId'";
                    $cart_sql_run = mysqli_query($conn, $cart_sql);
                    if (mysqli_num_rows($cart_sql_run) > 0) {
                        // Display the cart items in cards
                        while ($cart_item = mysqli_fetch_assoc($cart_sql_run)) {
                            $CartId = $cart_item["id"];
                            $product_name = $cart_item['product_name'];
                            $price = $cart_item['price'];
                            $totalPrice +=$price;
                            
                            // Display the cart item details in a card
                            echo '<div class="card">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">Name: ' . $product_name . '</h5>';
                            echo '<p class="card-text">Price: ' . $price . '</p>';
                            ?>
                            <a href="deleteItem.php?id=<?= $CartId ?>"><p class="deleteBtn">Delete</p></a>
                            <?php
                            echo '</div>';
                            echo '</div>';
                        }
                         ?>
                            <form method="POST" action="place_order.php">
                                <input type="hidden" name="total_price" value="<?= $totalPrice ?>">
                                <button type="submit" class="order-button">Place Order</button>
                            </form>                        <?php

                    } else {
                        // No items in the cart
                        echo '<p class="no-items">No items in the cart.</p>';
                    }
                }
            } else {
                // User is not logged in
                echo '<p class="login-message">Please log in to view your cart.</p>';
            }
            ?>
        </div>

        <?php
        if (isset($_SESSION['auth'])) {
            $email = $_SESSION['auth'];
            $sql = "SELECT id FROM users WHERE email='$email'";
            $sql_run = mysqli_query($conn, $sql);
            if ($sql_run && mysqli_num_rows($sql_run) > 0) {
                $row = mysqli_fetch_assoc($sql_run);
                $userId = $row['id'];

                // Get the cart items for the user
                $billing_sql = "SELECT * FROM users WHERE id = '$userId'";
                $billing_sql_run = mysqli_query($conn, $billing_sql);
                if (mysqli_num_rows($billing_sql_run) > 0) {
                    // Display the cart items in cards
                    while ($billing = mysqli_fetch_assoc($billing_sql_run)) {
                        $user_name = $billing['name'];
                        $user_address = $billing['address'];
                        $user_phone = $billing['phone'];
                        $user_email = $billing['email'];

                        ?>
                        <div class="cardAddress">
                            <div class="billing-address">
                                <h2>Billing Address</h2>
                                <p> Name: <?= ucwords($user_name) ?></p>
                                <p> Email: <?= ucwords($user_email) ?></p>
                                <p> Address: <?= ucwords($user_address) ?></p>
                                <p>Phone : <?= ucwords($user_phone) ?></p>
                                <p>User Id: <?= $userId ?></p>
                                <a href="editAddress.php?id=<?= $userId ?>" class="editBtn">Edit Info</a>
                                <p class="price">Total Price: $<?= $totalPrice ?></p>

                            </div>
                        </div>
                        <?php
                    }
                }
            }
        } 
        ?>

    </div>



</body>
<style>
        .container {
            display: flex;
            flex-direction: row;
            margin: 0;
            padding: 15px;
            font-family: Arial, sans-serif;
        }

        .cart-container {
            flex: 1;
            display:fle;
        }

        .billing-address {
            flex: 0.5;
            margin-left: 0px;
        }
        .delete {
        width: 300px;
        background-color: #f8d7da;
        color: #721c24;
        padding: 15px;
        border-radius: 10px;
        margin: 20px auto;
        text-align: center;
    }

    .delete.message {
        background-color: #f8d7da;
        color: #721c24;
    }
        .card {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            width: 200px;
            text-align: center;
            margin-bottom: 10px;
            margin-left: 50px;
            box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);
        }
        .cardAddress{
            margin-right: 50px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            width: 300px;
            text-align: center;
            margin-bottom: 10px;
            box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);
            height: 300px;
        }
        .card-title {
            font-size: 18px;
            margin-bottom: 5px;
        }
        .price{
            font-size: 18px;
            margin-bottom: 5px;
        }
        .card-text {
            font-size: 14px;
            color: #000;
            text-align: center;
        }

        .no-items {
            font-size: 16px;
            color: #888;
            transform: translate(50%);
        }

        .login-message {
            font-size: 16px;
            color: #888;
        }
        .editBtn{
            text-decoration: none;
            color: #000;
            padding: 5px;
            border-radius: 5px;
            font-size: 15px;
            background-color: silver;
        }
        .editBtn:hover{
            background-color: #000;
            color: #fff;
        }
        .deleteBtn {
            padding: 10px 20px;
            background-color: #e66465;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
        }

        .order-button {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</html>