<?php
include("../admin/navbar.php");
include("../database/connection.php");
$sql = "SELECT * FROM categories";
$sql_run = mysqli_query($conn, $sql);
?>
<div class="container">
    <div class="form-col">
    <?php
        if(isset($_SESSION['error'])){
        ?>
            <div class="alert delete">
                <?= $_SESSION['error'] ?>;
            </div>
        <?php
        }
        unset($_SESSION['error']);
        ?>
        <h2>Add Category</h2>
        <!-- Add Category form -->
        <form class="form" action="add_category.php" method="POST" enctype="multipart/form-data">
            <input name="category" type="text" placeholder="Add Category Name">
            <input name="image" type="file" accept="image/*">
            <button class="btn" type="submit">Add Category</button>
        </form>
    </div>

    <div class="form-col">
    <?php
        if(isset($_SESSION['error2'])){
        ?>
            <div class="alert delete">
                <?= $_SESSION['error2'] ?>;
            </div>
        <?php
        }
        unset($_SESSION['error2']);
        ?>
        <h2>Add Product</h2>
        <!-- Add Product form -->
        <form class="form" action="add_product.php" method="POST" enctype="multipart/form-data">
            <input name="product_name" type="text" placeholder="Add Product Name">
            <select name="product_category"> <!-- Use a dropdown select input for the category -->
            <?php
            // Fetch categories from the database
            if (mysqli_num_rows($sql_run) > 0) {
                foreach ($sql_run as $category) {
                    echo '<option value="' . $category['name'] . '">' . $category['name'] . '</option>';
                }
            }
            ?>
            </select>
            <input name="product_desc" type="text" placeholder="Add Product Description">
            <input name="product_price" type="text" placeholder="Add Product Price">
            <input name="image" type="file" accept="image/*">
            <br>
            <button class="btn3" type="submit">Add Product</button>
        </form>
    </div>

    <div class="manage-section">
        <h2>Manage Categories</h2>
        <a href="categories.php"><button class="btn2">Edit or Delete Category</button></a>
    </div>

    <div class="manage-section">
        <h2>Manage Products</h2>
        <a href="products.php"><button class="btn2">Edit or Delete Product</button></a>
    </div>
</div>
<style>
    .container {
        margin-top: 25px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    
    .form-col {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 15px;
    }
    .panel{
        margin-top: 20px;
        margin-left: 20px;
        cursor: pointer;
        font-size: 15px;
    }
    .form input {
        margin-top: 5px;
        padding: 8px;
        width: 250px;
    }
    .alert {
      width: 300px;
      background-color: #f8d7da;
      color: #721c24;
      padding: 15px;
      border-radius: 10px;
      margin: 20px auto;
      text-align: center;
    }
    .alert.delete {
      background-color: #f8d7da;
      color: #721c24;
    }
    .form button {
        margin-top: 10px;
        padding: 8px 16px;
        background-color: #4CAF50;
        color: #fff;
        border: none;
        text-decoration: none;
        cursor: pointer;
        align-items: center;
        justify-content: center;
    }

   
    .btn3{
        transform: translate(1070%,-150%);
    }

    .btn2 {
        padding: 8px 16px;
        background-color: #e66465;
        color: #fff;
        border: none;
        text-decoration: none;
        margin-top: 10px;
        cursor: pointer;
        align-items: center;
        justify-content: center;
    }

    .btn:hover {
        background-color: #45a049;
    }

    .btn2:hover {
        background-color: #D70C26;
    }

    h2 {
        margin-bottom: 10px;
    }
</style>