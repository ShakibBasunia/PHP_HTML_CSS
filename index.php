<?php 
include 'config.php'; 
?>
<!DOCTYPE html>

<html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <link rel="stylesheet" href="admin.css" />
    
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link rel="shortcut icon" href="./fav.png" type="image/x-icon">
    <title>Admin Dashboard</title>
  </head>
  <body>
    <nav class="navbar">
      <h1 class="navbar-title"><i class="bx bxs-dashboard"></i> Dashboard</h1>
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
          <a href="productList.php"><i class="bx bx-edit-alt"></i>Product List</a>
        </li>
<!-- New link to "Add Live Match" -->
        <li>
          <a href="add_live_match.php"><i class="bx bxs-video"></i>Add Live Match</a>
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
    
  </body>
</html>
