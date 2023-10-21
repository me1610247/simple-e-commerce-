<?php
include("../admin/navbar.php");
include("../database/connection.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order List</title>
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
</head>
<body>
<div class="container">
    <?php
    if (isset($_SESSION['admin'])) {
        // Admin is logged in
        $admin_email = $_SESSION['admin'];

        // Retrieve unique user IDs with their respective orders
        $orders_sql = "SELECT o.user_id, u.email
                       FROM orders AS o
                       INNER JOIN users AS u ON o.user_id = u.id
                       GROUP BY o.user_id";
        $orders_result = mysqli_query($conn, $orders_sql);

        if ($orders_result && mysqli_num_rows($orders_result) > 0) {
            ?>

            <h2>Order List</h2>

            <table>
                <tr>
                    <th>User ID</th>
                    <th>User Email</th>
                    <th>Details</th>
                </tr>

                <?php
                while ($order = mysqli_fetch_assoc($orders_result)) {
                    $user_id = $order['user_id'];
                    $user_email = $order['email'];
                    ?>

                    <tr>
                        <td><?php echo $user_id; ?></td>
                        <td><?php echo $user_email; ?></td>
                        <td><a href="viewOrders.php?user_id=<?php echo $user_id; ?>">View Orders</a></td>
                    </tr>

                    <?php
                }
                ?>
            </table>

            <?php
        } else {
            echo "<p class='error'>No orders found.</p>";
        }
    } else {
        // Admin is not logged in
        echo "<p class='error'>Please log in as an admin to access this page.</p>";
    }
    ?>
</div>
</body>
</html>