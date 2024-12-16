<?php
    include 'config.php';  // Include the database configuration file

    // Check if the 'id' parameter is present in the URL to delete a product
    if (isset($_GET['id'])) {
        $productId = $_GET['id'];

        // Validate the ID (ensure it is a number and positive)
        if (filter_var($productId, FILTER_VALIDATE_INT) && $productId > 0) {
            // Prepare the delete query
            $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
            $stmt->bind_param("i", $productId);  // Bind the product ID parameter as an integer

            // Execute the query
            if ($stmt->execute()) {
                $stmt->close(); // Close the statement before exiting
                // Redirect to the product list page with a success message
                header("Location: productList.php?message=Product deleted successfully.");
                exit;
            } else {
                $stmt->close(); // Close the statement before exiting
                // If the query fails, redirect to the product list with an error message
                header("Location: productList.php?message=Error deleting product. Please try again.");
                exit;
            }
        } else {
            // Invalid ID
            header("Location: productList.php?message=Invalid product ID.");
            exit;
        }
    }

    // Fetch all products from the database
    $query = "SELECT * FROM products";
    $result = $conn->query($query);
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="productList.css">
    <title>Product List</title>
</head>
<body>

    <nav class="navbar">
        <h1 class="navbar-title"><a href="index.php"><i class="bx bxs-dashboard"></i></a> Dashboard</h1>
    </nav>
    <div class="sidebar">
      <ul class="sidebar-menu">
        <li>
          <a href="addproduct.php"><i class="bx bxs-book-add"></i>Add Products</a>
        </li>
        <li>
          <a href="productList.php"><i class="bx bx-edit-alt"></i>Products List</a>
        </li>
        <li>
          <a href="add_live_match.php"><i class="bx bxs-book-add"></i>Add Live Match</a>
        </li>
        <li>
          <a href="addBlog.php"><i class="bx bxs-book-add"></i>Add Blog</a>
        </li>
        <li>
          <a href="showOrder.php"><i class="bx bx-edit-alt"></i>Invoice</a>
        </li>
        <li>
          <a href="calender.html"><i class="bx bxs-calendar"></i>Calendar</a>
        </li>
        <li>
          <a href="login.php"><i class="bx bx-log-out-circle"></i>Logout</a>
        </li>
      </ul>
    </div>

    <section class="container my-2">
        <h2 class="text-center py-5"><b>Product List</b></h2>

        <!-- Admin Dashboard Button -->
        <div class="text-center mb-3">
            <a href="index.php" class="btn btn-primary">Admin Dashboard</a>
        </div>

        <?php
            // Display any message (success or error)
            if (isset($_GET['message'])) {
                echo '<div class="alert alert-info">' . htmlspecialchars($_GET['message']) . '</div>';
            }

            if ($result->num_rows > 0) {
                // If there are products, display them in a table
                echo '<table class="table table-bordered">';
                echo '<thead><tr><th>Product Name</th><th>Price</th><th>Category</th><th>Details</th><th>Image</th><th>Actions</th></tr></thead><tbody>';
                
                while ($row = $result->fetch_assoc()) {
                    // Display product details and image
                    $productDetails = htmlspecialchars($row['product_details']);
                    $imageData = base64_encode($row['image']); // Assuming image is stored as binary
                    $imageSrc = 'data:image/jpeg;base64,' . $imageData; // Display image as base64

                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row['name']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['price']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['category']) . '</td>';
                    echo '<td>' . $productDetails . '</td>';
                    echo '<td><img src="' . $imageSrc . '" alt="Product Image" width="100"></td>';
                    echo '<td><a href="productList.php?id=' . $row['id'] . '" class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete this product?\');">Delete</a></td>';
                    echo '</tr>';
                }
                
                echo '</tbody></table>';
            } else {
                // If no products are found, display a message
                echo '<p>No products found.</p>';
            }
        ?>

    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
    // Close the database connection
    $conn->close();
?>
