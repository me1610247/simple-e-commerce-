<?php

include("../admin/navbar.php");
include("../database/connection.php");

// Check if the cart session exists, if not, create it
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if (isset($_GET['category'])) {
    $category_id = $_GET['category'];
    $category_sql = "SELECT name FROM categories WHERE id = '$category_id'";
    $category_result = mysqli_query($conn, $category_sql);
    if (mysqli_num_rows($category_result) > 0) {
        $category = mysqli_fetch_assoc($category_result);
        $category_name = $category['name'];
        $sql = "SELECT * FROM products WHERE product_category = '$category_name'";
    } else {
        $sql = "SELECT * FROM products";
    }
} else {
    $sql = "SELECT * FROM products";
}

$sql_run = mysqli_query($conn, $sql);
?>

<?php
if (isset($_SESSION['delete'])) {
    ?>
    <div class="delete message">
        <?= $_SESSION['delete']; ?>
    </div>
    <?php
}
unset($_SESSION['delete']);
?>
<div class="container">
    <?php
    if (mysqli_num_rows($sql_run) > 0) {
        foreach ($sql_run as $product) {
            $price = $product['price'];
            $discountedPrice = $price - ($price * 0.1); // Assuming a 10% discount
            ?>
            <div class="card">
                <div class="image-container">
                    <img src="../uploads/<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
                </div>
                <p class="name">Name: <?= ucwords($product['name']) ?></p>
                <p class="name">Category: <?= ucwords($product['product_category']) ?></p>
                <p class="description">Description: <?= $product['description'] ?></p>

                <div class="price-container">
                    <p class="price">Price: <?= $price ?></p>
                    <p class="discounted-price">Discounted Price: <?= $discountedPrice ?></p>
                </div>
                <div class="buttons">
                    <a href="cart.php?id=<?= $product['id'] ?>"><button style="margin-right:20px" class="addBtn">Add To Cart</button></a>
                </div>
            </div>
    <?php
        }
    } else {
        echo "<p>No products found.</p>";
    }
    ?>
</div>
<style>
    .container {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
    }

    .card {
        width: 300px;
        border-radius: 8px;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
        padding: 16px;
        margin: 16px;
        background-color: #fff;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .image-container {
        width: 100%;
        text-align: center;
        margin-bottom: 8px;
    }

    .image-container img {
        max-width: 100%;
        height: auto;
        border-radius: 4px;
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

    .name {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 8px;
    }

    .description {
        margin-bottom: 8px;
        font-size: 18px;
    }

    .price-container {
        display: flex;
        flex-direction: column;
        margin-bottom: 8px;
    }

    .price,
    .discounted-price {
        font-weight: bold;
        color: #4CAF50;
        margin-bottom: 4px;
    }

    .buttons {
        display: flex;
        justify-content: space-between;
        margin-top: 16px;
    }

    .addBtn {
        padding: 8px 16px;
        background-color: #4CAF50;
        color: #fff;
        border: none;
        text-decoration: none;
        cursor: pointer;
        border-radius: 4px;
        transform: translate(80%);
    }

  

    .addBtn:hover {
        background-color: #45a049;
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
</style>