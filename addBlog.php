<?php
include 'config.php'; // Assuming your config.php connects to the database

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST['blog_title']) &&
        isset($_POST['blog_description']) &&
        isset($_FILES['blog_image']) &&
        $_FILES['blog_image']['error'] === UPLOAD_ERR_OK &&
        isset($_POST['read_more_link'])
    ) {
        // Get the form data
        $blogTitle = $_POST['blog_title'];
        $description = $_POST['blog_description'];
        $readMoreLink = $_POST['read_more_link'];

        // Handle image upload
        $imagePath = null;
        if ($_FILES['blog_image']['error'] === UPLOAD_ERR_OK) {
            // Get the file name and set the target folder to 'assets/images/'
            $fileName = basename($_FILES['blog_image']['name']);
            $targetDirectory = 'assets/images/';
            $filePath = $targetDirectory . $fileName;  // Full path where the image will be stored

            // Ensure the 'assets/images/' directory exists
            if (!is_dir($targetDirectory)) {
                mkdir($targetDirectory, 0777, true);  // Create the directory if it doesn't exist
            }

            // Move the uploaded file to the 'assets/images/' folder
            if (move_uploaded_file($_FILES['blog_image']['tmp_name'], $filePath)) {
                $imagePath = $filePath;
            } else {
                echo "<script>alert('Image upload failed.');</script>";
                exit;
            }
        }

        // Use prepared statement to insert data into the database
        $sql = "INSERT INTO blogs (title, image, description, read_more_link) VALUES (?, ?, ?, ?)";

        // Prepare the statement
        $statement = $conn->prepare($sql);

        if ($statement === false) {
            // If prepare fails, output the error message
            die('Error preparing the query: ' . $conn->error);  // For MySQLi
        }

        // Bind parameters (without author)
        $statement->bind_param("ssss", $blogTitle, $imagePath, $description, $readMoreLink);

        // Execute the statement
        if ($statement->execute()) {
            session_start();
            echo "<script>alert('Blog Added Successfully');</script>";
            header("Location: addBlog.php");
            exit;
        } else {
            echo "<script>alert('Blog addition failed. Please try again.');</script>";
        }

        // Close the prepared statement
        $statement->close();
    } else {
        echo "<script>alert('Please fill in all required fields.');</script>";
    }
}
?>

<!-- The rest of your HTML form remains unchanged -->
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Add A Blog Post</title>
    <link rel="stylesheet" href="adminSideNav.css">
    <link rel="stylesheet" href="addproduct.css">
</head>
<body>
    <nav class="navbar">
        <h1 class="navbar-title"><a href="index.php"><i class="bx bxs-dashboard"></a></i> Dashboard</h1>
        <div class="user-profile">
            <img src="assets/images/userP.jpg" alt="User Profile" />
            <i class="bx bxs-bell-ring"></i>
        </div>
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
                <a href="add_blog.php"><i class="bx bxs-book-add"></i>Add Blog</a>
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
    
    <h2 class="text-center py-5"><b>Add  Blog Post</b></h2>
    <section class="container glass my-2 w-50 text-light p-2">
        <div class="text-center">
        <form action="addBlog.php" method="post" enctype="multipart/form-data">
            <fieldset>
                <label>Blog Title</label>
                <input type="text" id="blog-title" name="blog_title" required>
            </fieldset>
            <fieldset>
                <label>Blog Description</label>
                <textarea id="blog-description" class="form-control" name="blog_description" rows="8" required></textarea>  
            </fieldset>
            <fieldset>
                <label>Blog Image</label><br>
                <input type="file" id="blog-image" name="blog_image" accept="image/*" required>
            </fieldset>
            <fieldset>
                <label>Read More Link</label>
                <input type="url" id="read-more-link" name="read_more_link" required>
            </fieldset>  
            <input class="button" id="submit" type="submit" value="Add Blog">
        </form>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
