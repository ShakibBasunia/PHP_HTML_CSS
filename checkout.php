<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="fav.png" type="image/x-icon">
    <title>Checkout Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        <?php include './assets/css/style.css'?>
        <?php include './assets/css/page.css';?>
        <?php include 'css/slick.css';?>
        <?php include 'css/slick-theme.css';?>

        .details {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
        }

        .inputBox {
            margin-bottom: 10px;
        }

        .inputBox span {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            color: #5f3dad; /* Added font color */
        }

        .inputBox input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            color: #FFFFFF;
        }

        .select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .btn {
            background-color: #5f3dad;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn:hover {
            background-color:#5f3dad;
        }

        .order-message-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .order-message-container h3 {
            font-size: 30px;
        }

        .heading {
            margin-top: 5rem;
        }
    </style>
</head>

<body>
    <?php include 'navbar.php'; ?>

    <?php
    include 'config.php';

    if (isset($_POST['order_btn'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $number = mysqli_real_escape_string($conn, $_POST['number']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $method = mysqli_real_escape_string($conn, $_POST['method']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);

        $cart_query = mysqli_query($conn, "SELECT * FROM `cart`");
        $price_total = 0;
        $product_name = [];
        if (mysqli_num_rows($cart_query) > 0) {
            while ($product_item = mysqli_fetch_assoc($cart_query)) {
                $product_name[] = $product_item['name'] . ' (' . $product_item['qty'] . ') ';
                $product_price = $product_item['price'] * $product_item['qty'];
                $price_total += $product_price;
            }
        }

        $total_product = implode(', ', $product_name);
        $detail_query = mysqli_query($conn, "INSERT INTO `orders`(name, number, email, method, address, total_price) VALUES('$name','$number','$email','$method', '$address', '$price_total')") or die('query failed');

        if ($cart_query && $detail_query) {
            echo "
            <div class='order-message-container py-5'>
                <div class='message-container'>
                    <h3>Thank you for shopping!</h3>
                    <div class='order-detail'>
                        <span class='total text-center'><b>Grand Total: TK " . number_format($price_total) . "/-</b></span>
                    </div>
                    <div class='customer-details'>
                        <p><b>Customer name:</b> <span>$name</span></p>
                        <p><b>Contact number:</b> <span>$number</span></p>
                        <p><b>Your E-mail:</b> <span>$email</span></p>
                        <p><b>Shipping Address:</b> <span>$address</span></p>
                        <p><b>Payment Mode:</b> <span>$method</span></p>
                    </div>
                    <a href='shop.php' class='btn'>Done</a>
                </div>
            </div>
            ";
            mysqli_query($conn, "DELETE FROM cart");
        }
    }
    ?>

    <div class="container">
        <section class="checkout-form">
            <h1 class="heading">Fill out the form for confirmation</h1>

            <form action="" method="post">
                <div class="display-order">
                    <?php
                    $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
                    $grand_total = 0;
                    if (mysqli_num_rows($select_cart) > 0) {
                        while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                            $total_price = $fetch_cart['price'] * $fetch_cart['qty'];
                            $grand_total += $total_price;
                            ?>
                            <h4><?= $fetch_cart['name']; ?> <span>(<?= $fetch_cart['qty']; ?>)</span></h4>
                            <?php
                        }
                    } else {
                        echo "<div class='display-order'><span>Your cart is empty!</span></div>";
                    }
                    ?>

                    <span class="grand-total">Grand total: TK <?= number_format($grand_total); ?>/-</span>
                </div>

                <div class="details">
                    <div class="inputBox">
                        <span>Name</span>
                        <input type="text" placeholder="Full Name" name="name" required>
                    </div>
                    <div class="inputBox">
                        <span>Number</span>
                        <input type="text" placeholder="Contact Number" name="number" required>
                    </div>
                    <div class="inputBox">
                        <span>Email</span>
                        <input type="email" placeholder="Email Address" name="email" required>
                    </div>
                    <div class="inputBox">
                        <span>Payment method</span>
                        <select name="method" class="select" required>
                            <option value="cash on delivery" selected>Cash On Delivery</option>
                            <option value="credit card">Credit Card</option>
                            <option value="rocket">Rocket</option>
                            <option value="bkash">Bkash</option>
                            <option value="nagad">Nagad</option>
                        </select>
                    </div>
                    <div class="inputBox">
                        <span>Address</span>
                        <input type="text" placeholder="Delivery Address" name="address" required>
                    </div>
                </div>

                <input type="submit" value="Order Now" name="order_btn" class="btn">
            </form>
        </section>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>