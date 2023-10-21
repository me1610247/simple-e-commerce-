<?php
include("../admin/navbar.php");
include("../database/connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = $_POST['product_name'];
    $product_desc = $_POST['product_desc'];
    $product_price = $_POST['product_price'];
    $product_category = $_POST['product_category']; // Get the selected category ID

    // Handle image upload
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_path = "../uploads/" . $image_name;

    move_uploaded_file($image_tmp, $image_path);
        if(empty($product_name)){
            $_SESSION['error2']="Enter Product Name";
            header("location:admin.php");
        }elseif(empty($product_category)){
            $_SESSION['error2']="Select Product Category";
            header("location:admin.php");
        }elseif(empty($product_price)){
            $_SESSION['error2']="Enter Product Price";
            header("location:admin.php");
        }elseif(empty($image_name)){
            $_SESSION['error2']="Upload Product Image";
            header("location:admin.php");
        }
        elseif(empty($product_desc)){
            $_SESSION['error2']="Enter Product Description !";
            header("location:admin.php");
        }else{
    // Insert the data into the database
    $sql = "INSERT INTO products (name, description, price, image, product_category)
     VALUES ('$product_name', '$product_desc', '$product_price', '$image_name', '$product_category')";
    $sql_run = mysqli_query($conn, $sql);
        }
    if ($sql_run) {
        header("location: admin.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>