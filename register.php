<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: linear-gradient(to bottom right, #e66465, #9198e5);
      background-repeat: no-repeat;
      background-size: cover;
      background-attachment: fixed;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 80vh;
    }
    
    .container {
      width: 400px;
      background-color: #fff;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
      animation: scale-up 0.5s ease-in-out;
      padding-top: 10px;
    }
    
    .container h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #333;
    }
    
    .container input[type="text"],
    .container input[type="password"] {
      width: 100%;
      padding: 15px;
      border: none;
      background-color: #f7f7f7;
      border-radius: 6px;
      margin-bottom: 20px;
      color: #555;
    }
    
    .login {
      width: 100%;
      padding: 15px;
      border: none;
      background-color:#e66465;
      color: #fff;
      cursor: pointer;
      border-radius: 6px;
      transition:  0.3s ease-in-out;
    }
    .login:hover{
        background-color: rgb(247, 22, 49);
    }
    .register{
        margin-top: 10px;
        width: 100%;
      padding: 15px;
      border: none;
      background-color: rgb(145, 136, 135);
      color: #fff;
      cursor: pointer;
      border-radius: 6px;
      transition: background-color 0.3s ease-in-out;
    }
    .register:hover{
        background-color: #000;
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
    
    .alert.error {
      background-color: #f8d7da;
      color: #721c24;
    }
    
    @keyframes scale-up {
      from {
        transform: scale(0.8);
        opacity: 0;
      }
      to {
        transform: scale(1);
        opacity: 1;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Login</h2>
    <form method="POST" action="handlers/validateRegister.php">
        <?php
        if(isset($_SESSION['error'])){
        ?>
         <div class="alert error">
            <?= $_SESSION['error']; ?>
        </div>
        <?php
        }
        unset($_SESSION['error']);
        ?>
      <input type="text" name="username" placeholder="Username" >
      <input type="text" name="email" placeholder="Email" >
      <input type="text" name="phone" placeholder="Phone Number" >
      <input type="text" name="address" placeholder="Address" >
      <input type="password" name="password" placeholder="Password" >
      <input type="password" name="confirmpassword" placeholder="Confirm Password" >
      <input class="login" type="submit" value="Sign up">
    </form>
    <a href="index.php"><button class="register">Already Have an Account</button></a>
  </div>
</body>
</html>