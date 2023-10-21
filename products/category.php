<?php
include("../admin/navbar.php");
include("../database/connection.php");
$sql = "SELECT * FROM categories";
$sql_run = mysqli_query($conn, $sql);
?>
   <?php
    if (isset($_SESSION['addSuccess'])) {
        ?>
        <div class="add message">
            <?= $_SESSION['addSuccess'] ?>;
        </div>
        <?php
    }
    unset($_SESSION['addSuccess']);
    ?>
   <?php
    if (isset($_SESSION['order'])) {
        ?>
        <div class="order done">
            <?= $_SESSION['order'] ?>;
        </div>
        <?php
    }
    unset($_SESSION['order']);
    ?>
<div class="container">
    <?php
    if (mysqli_num_rows($sql_run) > 0) {
        foreach ($sql_run as $category) {
            $category_id = $category['id']; // Get the category ID
            ?>
            <div class="card">
            <p class="name"><?= ucwords($category['name']) ?></p>
                <div class="image-container">
                    <img width="200px" height="150px" src="../uploadsCategory/<?= $category['image'] ?>" alt="<?= $category['name'] ?>">
                </div>
                <div class="buttons">
                    <a href="products.php?category=<?= $category_id ?>"><button class="view-products-btn">View Products</button></a> <!-- Add a new button to view products for the category -->
                </div>
            </div>
    <?php
        }
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
    .view-products-btn {
        padding: 8px 16px;
        background-color: #007bff;
        color: #fff;
        border: none;
        text-decoration: none;
        cursor: pointer;
        border-radius: 4px;
        margin-left: 15px;
        transform: translate(65%);
    }


    .view-products-btn:hover {
        background-color: #0056b3;
    }
    .card {
        width: 300px;
        border-radius: 8px;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
        padding: 16px;
        opacity: 0;
        animation: fade-in 0.5s ease-in-out forwards;
        margin: 16px;
        background-color: #fff;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        border: 1px solid silver;
    }

    .image-container {
        width: 100%;
        text-align: center;
        margin-bottom: 8px;
    }

    .image-container img {
        max-width: 60%;
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
        text-align: center;
    }
    .add {
        width: 300px;
        background-color: #4CAF50;
        color: #fff;
        padding: 15px;
        border-radius: 10px;
        margin: 20px auto;
        text-align: center;
    }

    .add.message {
        background-color: #4CAF50;
        color: #fff;
    }
    .order {
        width: 300px;
        background-color: #4CAF50;
        color: #fff;
        padding: 15px;
        border-radius: 10px;
        margin: 20px auto;
        text-align: center;
    }
    .order.done {
        background-color: #4CAF50;
        color: #fff;
    }


    .buttons {
        display: flex;
        justify-content: space-between;
        margin-top: 16px;
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
    .edit-btn,
    .delete-btn {
        padding: 8px 16px;
        background-color: #4CAF50;
        color: #fff;
        border: none;
        text-decoration: none;
        cursor: pointer;
        border-radius: 4px;
    }

    .delete-btn {
        background-color: #f44336;
    }

    .edit-btn:hover {
        background-color: #45a049;
    }
</style>