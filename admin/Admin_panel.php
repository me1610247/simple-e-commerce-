<?php
include("../admin/navbar.php");
include("../database/connection.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <style>
        body {
            background-color: #f2f2f2;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            
        }
        @keyframes fade-in {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
        h2 {
            margin-top: 0;
            text-align: center;
            color: #333;
        }

        .dashboard-card {
            background-color: #f9f9f9;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        h3 {
            margin-top: 0;
            color: #666;
        }

        p {
            margin: 0;
            color: #999;
        }

        .dashboard-card:nth-child(odd) {
            background-color: #e9e9e9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Panel</h2>

        <div class="dashboard-card">
            <a href="users.php"><h3>Users</h3></a>
            <?php
            // Count the number of users in the 'users' table
            $users_sql = "SELECT COUNT(*) AS total_users FROM users";
            $users_result = mysqli_query($conn, $users_sql);
            $users_row = mysqli_fetch_assoc($users_result);
            $total_users = $users_row['total_users'];
            ?>
            <p>Total Users: <?php echo $total_users; ?></p>
        </div>
        <div class="dashboard-card">
            <a href="archeive.php"><h3>Deleted Users</h3></a>
            <?php
            // Count the number of users in the 'users' table
            $users_sql = "SELECT COUNT(*) AS total_users_deleted FROM users_archeive";
            $users_result = mysqli_query($conn, $users_sql);
            $users_row = mysqli_fetch_assoc($users_result);
            $total_users = $users_row['total_users_deleted'];
            ?>
            <p>Total Users Deleted: <?php echo $total_users; ?></p>
        </div>

        <div class="dashboard-card">
            <a href="categories.php"><h3>Categories</h3></a>
            <?php
            // Count the number of categories in the 'categories' table
            $categories_sql = "SELECT COUNT(*) AS total_categories FROM categories";
            $categories_result = mysqli_query($conn, $categories_sql);
            $categories_row = mysqli_fetch_assoc($categories_result);
            $total_categories = $categories_row['total_categories'];
            ?>
            <p>Total Categories: <?php echo $total_categories; ?></p>
        </div>

        <div class="dashboard-card">
            <h3>Products</h3>
            <?php
            // Count the number of products in the 'products' table
            $products_sql = "SELECT COUNT(*) AS total_products FROM products";
            $products_result = mysqli_query($conn, $products_sql);
            $products_row = mysqli_fetch_assoc($products_result);
            $total_products = $products_row['total_products'];
            ?>
            <p>Total Products: <?php echo $total_products; ?></p>
        </div>
        <div class="dashboard-card">
            <a href="Admin_order.php"><h3>Orders</h3></a>
            <?php
            // Count the number of products in the 'products' table
            $products_sql = "SELECT COUNT(*) AS total_orders FROM orders";
            $products_result = mysqli_query($conn, $products_sql);
            $products_row = mysqli_fetch_assoc($products_result);
            $total_products = $products_row['total_orders'];
            ?>
            <p>Orders : <?php echo $total_products; ?></p>
        </div>
    </div>
</body>
</html>