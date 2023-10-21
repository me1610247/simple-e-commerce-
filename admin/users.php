<!DOCTYPE html>
<html>
<head>
    <title>User List</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            background-color: #f2f2f2;
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
    .archeive{
        text-decoration: none;
        text-align: center;
        color: #000;
        padding: 3px;
        align-items: center;
        font-weight: bold;
        font-size: 18px;
    }
    .alert.delete {
      background-color: #f8d7da;
      color: #721c24;
    }
    .row{
        display: flex;
        justify-content: space-between;
    }
    .editBtn{
        color: #000;
        background-color: silver;
        padding: 5px;
        border-radius: 5px;
        text-decoration: none;
    }
    .deleteBtn{
        text-decoration: none;
        color: #fff;
        background-color: #e66465;
        padding: 6px;
        border-radius: 7px;
    }
    </style>
</head>
<body>
    <?php
        include("../admin/navbar.php");
        include("../database/connection.php");
        
        $sql = "SELECT * FROM users";
        $sql_run = mysqli_query($conn, $sql);
    ?>
    <div class="row">
    <h2 style="margin-left:8px">User List  </h2>
    <a style="margin-top:26px;margin-left:10px" class="archeive" href="archeive.php"> Show Deleted Accounts</a>
    </div>
        <?php
        if(isset($_SESSION['deleteUser'])){
        ?>
            <div class="alert delete">
                <?= $_SESSION['deleteUser'] ?>;
            </div>
        <?php
        }
        unset($_SESSION['deleteUser']);
        ?>
    <table>
        <tr>
            <th>User ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Role</th>
            <th>Action</th>
            <!-- Add more columns if needed -->
        </tr>

        <?php while ($row = mysqli_fetch_assoc($sql_run)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['address']; ?></td>
                <td>
                    <?php echo $row['role']=='0'?"User":"Admin"; ?>
                    <a class="editBtn" href="editUser.php?id=<?= $row['id'] ?>">Edit</a>

                </td>
                <td>
                    <a class="deleteBtn" href="deleteUser.php?id=<?=$row['id']?>">Delete</a>
                </td>
                <!-- Add more columns if needed -->
            </tr>
        <?php } ?>
    </table>
</body>
</html>