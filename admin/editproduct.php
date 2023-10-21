<?php
include("../admin/navbar.php");
include("../database/connection.php");
if (isset($_POST['submit'])) {
    // Get the form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    // Update the user record
    $update_query = "UPDATE products SET name = '$name', price='$price',description='$description' WHERE id = $id";
    mysqli_query($conn, $update_query);

    // Redirect to the user list page
    header("Location: index.php");
    exit();
}

// Check if the user ID is provided in the query parameter
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the user record from the database
    $category_query = "SELECT * FROM products WHERE id = $id";
    $category_result = mysqli_query($conn, $category_query);
    $category = mysqli_fetch_assoc($category_result);
} else {
    // Redirect to the user list page if the user ID is not provided
    header("Location:categories.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        .form-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
            border-radius: 5px;
            margin-top: 25px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group button {
            padding: 8px 16px;
            background-color: #4caf50;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
            transform: translate(200%);
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h4>Edit Product</h4>
        <form action="updateproduct.php" method="POST">
            <input type="hidden" name="id" value="<?= $category['id']; ?>">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" value="<?= $category['name']; ?>" name="name" placeholder="Enter Category Name">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="description" value="<?= $category['description']; ?>" name="description" placeholder="Enter Category Description">
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" id="price" value="<?= $category['price']; ?>" name="price" placeholder="Price">
            </div>
            <div class="form-group">
                <button type="submit" name="update_category" class="btn btn-info">Update</button>
            </div>
        </form>
    </div>
</body>
</html>