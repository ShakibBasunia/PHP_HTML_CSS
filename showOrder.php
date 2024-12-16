<?php
include 'config.php';
session_start();
$statement = "SELECT * FROM orders";
$result = mysqli_query($conn, $statement);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
    $orderId = intval($_POST['order_id']);
    $updateStatus = "UPDATE orders SET status = 'Delivered' WHERE id = $orderId";
    mysqli_query($conn, $updateStatus);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/showOrderStyle.css">
    <link rel="stylesheet" href="./assets/css/navStyle.css">
    <link rel="stylesheet" href="adminSideNav.css">
    <link rel="shortcut icon" href="fav.png" type="image/x-icon">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <style>
        /* Change only the table text color to white */
        .table th, .table td {
            color: white; /* Ensure table text is white */
            background-color: #444; /* Dark background for table cells */
        }

        /* Additional customization for table borders */
        .table-bordered {
            border: 1px solid #555;
        }

        /* Button style adjustments */
        .btn {
            color: white; /* Button text color */
        }

        .btn-success {
            background-color: #28a745;
        }

        .btn-secondary {
            background-color: #6c757d;
        }
    </style>
</head>
<body>

<nav class="navbar">
    <h1 class="navbar-title"><a href="index.php"><i class="bx bxs-dashboard"></i></a> Dashboard</h1>
    <div class="user-profile">
        <img src="assets/images/userP.jpg" alt="User Profile" />
        <i class="bx bxs-bell-ring"></i>
    </div>
</nav>
<div class="sidebar">
    <ul class="sidebar-menu">
        <li><a href="addproduct.php"><i class="bx bxs-book-add"></i>Add Products</a></li>
        <li><a href="productList.php"><i class="bx bx-edit-alt"></i>Products List</a></li>
        <li><a href="add_live_match.php"><i class="bx bxs-book-add"></i>Add Live Match</a></li>
        <li><a href="addBlog.php"><i class="bx bxs-book-add"></i>Add Blog</a></li>
        <li><a href="showOrder.php"><i class="bx bx-edit-alt"></i>Invoice</a></li>
        <li><a href="calender.html"><i class="bx bxs-calendar"></i>Calendar</a></li>
        <li><a href="login.php"><i class="bx bx-log-out-circle"></i>Logout</a></li>
    </ul>
</div>
<h3 class="text-center py-5"><b>Recent Orders</b></h3>

<div class="container">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Number</th>
                <th>Email</th>
                <th>Method</th>
                <th>Address</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= htmlspecialchars($row['name']); ?></td>
                <td><?= htmlspecialchars($row['number']); ?></td>
                <td><?= htmlspecialchars($row['email']); ?></td>
                <td><?= htmlspecialchars($row['method']); ?></td>
                <td><?= htmlspecialchars($row['address']); ?></td>
                <td><?= htmlspecialchars($row['total_price']); ?></td>
                <td><?= htmlspecialchars($row['status'] ?? 'Not Delivered'); ?></td>
                <td>
                    <?php if (($row['status'] ?? 'Not Delivered') !== 'Delivered'): ?>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="order_id" value="<?= $row['id']; ?>">
                            <button type="submit" class="btn btn-success btn-sm">Mark as Delivered</button>
                        </form>
                    <?php else: ?>
                        <button class="btn btn-secondary btn-sm" disabled>Delivered</button>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php mysqli_close($conn); ?>

</body>
</html>
