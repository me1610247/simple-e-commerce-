<?php
include("../admin/navbar.php");
include("../database/connection.php");

if (isset($_SESSION['admin'])) {
    // Admin is logged in
    $admin_email = $_SESSION['admin'];

    if (isset($_GET['user_id'])) {
        // Get the user ID from the URL parameter
        $user_id = $_GET['user_id'];

        // Retrieve the orders for the given user ID
        $orders_sql = "SELECT o.*
                       FROM orders AS o
                       WHERE o.user_id = '$user_id'";
        $orders_result = mysqli_query($conn, $orders_sql);

        if ($orders_result && mysqli_num_rows($orders_result) > 0) {
            ?>

            <h2>Orders for User ID: <?php echo $user_id; ?></h2>

            <table>
                <tr>
                    <th>Order ID</th>
                    <!-- order details will taken from table order_items -->
                    <th>Product Name</th>
                    <th>Order Date</th>
                    <th>User Phone</th>
                    <th>User Address</th>
                </tr>

                <?php
                while ($order = mysqli_fetch_assoc($orders_result)) {
                    $order_id = $order['id'];
                    $order_date=$order['date'];
                    $order_phone=$order['user_phone'];
                    $order_address=$order['user_address'];

                    // Retrieve the order items for the current order
                    $order_items_sql = "SELECT oi.*
                                        FROM order_items AS oi
                                        WHERE oi.user_id = '$user_id'";
                    $order_items_result = mysqli_query($conn, $order_items_sql);

                    ?>

                    <tr>
                        <td><?php echo $order_id; ?></td>
                      
                        <td>
                            <?php
                                if($order_items_result && mysqli_num_rows($order_items_result)>0){
                                    while($item=mysqli_fetch_assoc($order_items_result)) {
                                        echo $item['product_name']. "<br>";
                                }
                            } else {
                                echo "No items found for this order.";

                            }
                            ?>
                        </td>
                        <td><?php echo $order_date; ?></td>
                        <td><?php echo $order_phone; ?></td>
                        <td><?php echo $order_address; ?></td>

                    </tr>

                    <?php
                }
                ?>
            </table>

            <?php
        } else {
            echo "No orders found for the user ID: $user_id.";
        }
    } else {
        echo "Invalid user ID.";
    }
} else {
    // Admin is not logged in
    echo "Please log in as an admin to access this page.";
}
?>
  <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        h2 {
            margin-top: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
        }

        .error {
            color: red;
        }
    </style>