<?php
// Include database connection
$host = 'localhost';  // Database host
$dbname = 'gameshop';  // Database name (updated)
$username = 'root';  // Database username
$password = '';  // Database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

$successMessage = $errorMessage = "";  // Initialize feedback messages

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data and sanitize inputs
    $firstName = htmlspecialchars(trim($_POST['first_name']));
    $lastName = htmlspecialchars(trim($_POST['last_name']));
    $email = htmlspecialchars(trim($_POST['e-mail']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate inputs
    if (!empty($firstName) && !empty($lastName) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($message)) {
        try {
            // Prepare and execute SQL query
            $stmt = $pdo->prepare("INSERT INTO messages (first_name, last_name, email, message) 
                                   VALUES (:first_name, :last_name, :email, :message)");
            $stmt->execute([
                ':first_name' => $firstName,
                ':last_name' => $lastName,
                ':email' => $email,
                ':message' => $message
            ]);
            $successMessage = "Your message has been submitted successfully!";
        } catch (PDOException $e) {
            $errorMessage = "There was an error saving your message: " . $e->getMessage();
        }
    } else {
        $errorMessage = "Please fill in all fields with valid information.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Overpass+Mono&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="./fav.png" type="image/x-icon">
    <title>Contact us</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./contact.css">
    <style>
        .header-bottom {
            position: relative;
            top: calc(100% - 1px);
            left: 0;
            width: 100%;
            background-color: var(--raisin-black-2);
            padding-block: 20px;
            z-index: 0;
        }
        .alert {
            margin: 10px 0;
            padding: 10px;
            border: 1px solid transparent;
            border-radius: 5px;
        }
        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
    </style>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <main>
        <div class="title">Contact us</div>
        <div class="title-info">We'll get back to you soon!</div>

        <!-- Display success or error messages -->
        <?php if (!empty($successMessage)): ?>
            <div class="alert alert-success"><?php echo $successMessage; ?></div>
        <?php endif; ?>
        <?php if (!empty($errorMessage)): ?>
            <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
        <?php endif; ?>

        <!-- Contact Form -->
        <form action="" method="POST" class="form">
            <div class="input-group">
                <input type="text" name="first_name" id="first-name" placeholder="First name" required>
                <label for="first-name">First name</label>
            </div>
            
            <div class="input-group">
                <input type="text" name="last_name" id="last-name" placeholder="Last Name" required>
                <label for="last-name">Last name</label>
            </div>

            <div class="input-group">
                <input type="email" name="e-mail" id="e-mail" placeholder="e-mail" required>
                <label for="e-mail">e-mail</label>
            </div>

            <div class="textarea-group">
                <textarea name="message" id="message" rows="5" placeholder="Message" required></textarea>
                <label for="message">Message</label>
            </div>

            <div class="button-div">
                <button type="submit">Send</button>
            </div>
        </form>

        <?php include 'footer.php'; ?>
    </main>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
