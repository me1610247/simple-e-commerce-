<?php
session_start();
include("database/connection.php");

// Check if the user is logged in
if (isset($_SESSION['auth'])) {
    $email = $_SESSION['auth'];
    $sql = "SELECT id FROM users WHERE email='$email'";
    $sql_run = mysqli_query($conn, $sql);

    if ($sql_run && mysqli_num_rows($sql_run) > 0) {
        $row = mysqli_fetch_assoc($sql_run);
        $userId = $row['id'];

        // Delete the user's cart
        $delete_cart_sql = "DELETE FROM cart WHERE user_id = '$userId'";
        if (mysqli_query($conn, $delete_cart_sql)) {
            // Cart deleted successfully
            unset($_SESSION['auth']);
            session_destroy();
            header("location: index.php");
        } else {
            // Failed to delete cart
            echo "Error: " . mysqli_error($conn);
        }
    }
} else {
    // User is not logged in, simply destroy the session and redirect
    session_destroy();
    header("location: index.php");
}
?>