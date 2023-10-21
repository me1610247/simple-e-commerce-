<?php
session_start();
include("../database/connection.php");

if (isset($_SESSION['auth'])) {
    $email = $_SESSION['auth'];
    $query = "SELECT name, email, role FROM users WHERE email = '$email'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run && mysqli_num_rows($query_run) > 0) {
        $row = mysqli_fetch_assoc($query_run);
        $userName = $row['name'];
        if ($row['role'] == 1) {
            $_SESSION['admin'] = "Go To Admin Dashboard";
        } elseif ($row['role'] == 0) {
            unset($_SESSION['admin']);
            $_SESSION['user'] = "Go To Categories";
        }
    } else {
        $userName = "Unknown";
    }
} else {
    $userName = "Unknown";
}
?>
<!DOCTYPE html>
<html>
<head>
  <style>
    body {
    margin: 0;
    padding: 0;
  }
  
  nav {
    background: linear-gradient(#e66465, rgb(145, 136, 135));
    height: 60px;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .welcome{
        font-size: 24px;
        color: #fff;
        font-weight: italic;
  }
  .navibar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    max-width: 960px;
    padding: 0 10px;
  }
  
  .logo {
    color: #fff;
    font-size: 24px;
    text-decoration: none;
  }
  
  .nav-links {
    list-style: none;
    display: flex;
    justify-content: space-between;
    width: 25%;
  }
  
  .nav-links li a {
    color: #fff;
    text-decoration: none;
  }
  
  .burger {
    display: none;
    cursor: pointer;
  }
  
  .burger div {
    width: 25px;
    height: 3px;
    background-color: #fff;
    margin: 5px;
    transition: all 0.3s ease;
  }
  
  @media screen and (max-width: 960px) {
    .nav-links {
      position: absolute;
      right: 0px;
      height: 92vh;
      top: 60px;
      background-color: #333;
      display: flex;
      flex-direction: column;
      align-items: center;
      width: 50%;
      transform: translateX(100%);
      transition: transform 0.5s ease-in;
    }
  
    .nav-links li {
      opacity: 0;
    }
    .burger {
      display: block;
    }
  }
  
  .nav-active {
    transform: translateX(0%);
  }
  
  @keyframes navLinkFade {
    from {
      opacity: 0;
      transform: translateX(50px);
    }
    to {
      opacity: 1;
      transform: translateX(0px);
    }
  }
  
  .toggle .line1 {
    transform: rotate(-45deg) translate(-5px, 6px);
  }
  
  .toggle .line2 {
    opacity: 0;
  }
  
  .toggle .line3 {
    transform: rotate(45deg) translate(-5px, -6px);
  }
  </style>
</head>
<body>
  <nav>
  <p class="welcome">Welcome <?= ucwords($userName) ?> -</p>
    <div class="navibar">
      <a href="../category.php" class="logo">PMS</a>
      <?php if (isset($_SESSION['admin'])) { ?>
      <ul class="nav-links" style="width:40%">
        <li><a href="../admin/admin.php"><?= $_SESSION['admin'] ?></</a></li>
        <li><a href="../admin/users.php">Users</a></li>
        <li><a href="../admin/categories.php">Category</a></li>
        <li><a href="../admin/products.php">Product</a></li>
        <li><a href="../logout.php">Logout</a></li>
      </ul>
    <?php } 
    else{
    ?>
            <ul class="nav-links" style="width:30%">
       <li><a href="../products/products.php">Products</a></li>
       <li><a href="../products/category.php">Categories</a></li>
       <li><a href="../logout.php">Logout</a></li>
       <?php } ?>
      </ul>
    </div>
  </nav>
</body>
</html>