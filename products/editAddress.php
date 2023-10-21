<?php
include("../admin/navbar.php");
include("../database/connection.php");
if (isset($_POST['submit'])) {
    // Get the form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
   
    // Update the user record
    $update_query = "UPDATE users SET name = '$name', phone='$phone',address='$address' WHERE id = $id";
    mysqli_query($conn, $update_query);

    // Redirect to the user list page
    header("Location: editAddress.php");
    exit();  
}
// Check if the user ID is provided in the query parameter
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the user record from the database
    $edit_query = "SELECT * FROM users WHERE id = $id";
    $edit_query_run = mysqli_query($conn, $edit_query);
    $edited = mysqli_fetch_assoc($edit_query_run);
} else {
    // Redirect to the user list page if the user ID is not provided
    header("Location:viewcart.php");
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
    </style>
</head>
<body>
    <div class="form-container">
    <?php
if (isset($_SESSION['error'])) {
    ?>
    <div class="delete message">
        <?= $_SESSION['error']; ?>
    </div>
    <?php
}
unset($_SESSION['error']);
?>
        <h4>Edit Information Of The User</h4>
        <form action="update_user.php" method="POST">
            <input type="hidden" name="id" value="<?= $edited['id']; ?>">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" value="<?= $edited['name']; ?>" name="name" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="description">Phone</label>
                <input type="text" id="phone" value="<?= $edited['phone']; ?>" name="phone" placeholder="Phone">
            </div>
            <div class="form-group">
                <label for="price">Address</label>
                <input type="text" id="address" value="<?= $edited['address']; ?>" name="address" placeholder="Address">
            </div>
            <div class="form-group">
                <button type="submit" name="update_user" class="btn btn-info">Update</button>
            </div>
        </form>
    </div>
</body>
</html>