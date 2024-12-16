<?php
// Include the database connection file
include 'config.php';  

// Initialize an empty message for feedback
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the live match URL from the form
    $liveMatchUrl = $_POST['live_match_url'];

    // Validate the URL to ensure it's a valid URL
    if (filter_var($liveMatchUrl, FILTER_VALIDATE_URL)) {
        // Prepare SQL query to insert the URL into the database
        $stmt = $conn->prepare("INSERT INTO live_matches (match_url) VALUES (?)");
        $stmt->bind_param("s", $liveMatchUrl);  // Bind the parameter

        // Execute the query
        if ($stmt->execute()) {
            $message = 'Live match added successfully.';
        } else {
            $message = 'Error adding live match. Please try again.';
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        $message = 'Invalid URL. Please enter a valid URL.';
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Live Match</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="add_live_match.css">
</head>
<body>

<!-- Admin Dashboard Section -->
<section class="section add-live-match" id="add-live-match">
  <div class="container">
    <h2 class="h2 section-title">Add Live Match</h2>

    <!-- Back to Admin Dashboard Button -->
    <div class="mb-3">
      <a href="index.php" class="btn btn-secondary">Back to Admin Dashboard</a>
    </div>

    <!-- Display any feedback message (success/error) -->
    <?php if ($message): ?>
      <div class="alert alert-info"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <!-- Live Match Form -->
    <form action="add_live_match.php" method="POST" class="form">
      <div class="form-group mb-3">
        <label for="live_match_url">Live Match URL:</label>
        <input type="url" id="live_match_url" name="live_match_url" class="form-control" required placeholder="Enter live match URL">
      </div>

      <button type="submit" class="btn btn-primary">Add Live Match</button>
    </form>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
