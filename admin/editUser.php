<?php
include("../admin/navbar.php");
include("../database/connection.php");
if (isset($_POST['submit'])) {
    // Get the form data
    $id = $_POST['id'];
    $role=$_POST['role'];
    $
    // Update the user record
    $update_query = "UPDATE users SET role='$role' WHERE id = $id";
    mysqli_query($conn, $update_query);

    // Redirect to the user list page
    header("Location: users.php");
    exit();
}

// Check if the user ID is provided in the query parameter
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the user record from the database
    $user_query = "SELECT * FROM users WHERE id = $id";
    $user_query_run = mysqli_query($conn, $user_query);
    $user = mysqli_fetch_assoc($user_query_run);
} else {
    // Redirect to the user list page if the user ID is not provided
    header("Location:users.php");
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

        .form-group select {
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
        <h4>Edit User</h4>
        <form action="updateUser.php" method="POST">
            <input type="hidden" name="id" value="<?= $user['id']; ?>">
            <div class="form-group">
                <label for="role">Role</label>
                <select id="role" name="role">
                    <option value="0" <?= $user['role'] == '0' ? 'selected' : ''; ?>>User</option>
                    <option value="1" <?= $user['role'] == '1' ? 'selected' : ''; ?>>Admin</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" name="update_category" class="btn btn-info">Update</button>
            </div>
        </form>
    </div>
</body>
</html>