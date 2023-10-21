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
    
    .alert.delete {
      background-color: #f8d7da;
      color: #721c24;
    }
    .row{
        display: flex;
    }
    </style>
</head>
<body>
    <?php
        include("../admin/navbar.php");
        include("../database/connection.php");
        
        $sql = "SELECT * FROM users_archeive";
        $sql_run = mysqli_query($conn, $sql);
    ?>
    <div class="row">
    <h2 style="margin-left:8px">Archeive List  </h2>
    </div>
    <table>
        <tr>
            <th>User ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <!-- Add more columns if needed -->
        </tr>

        <?php while ($row = mysqli_fetch_assoc($sql_run)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['address']; ?></td>
                
                <!-- Add more columns if needed -->
            </tr>
        <?php } ?>
    </table>
</body>
</html>