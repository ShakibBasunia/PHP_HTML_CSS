

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>G-Shop -Explore a wide range of authentic and quality products
  </title>
  <!-- favicon -->
  
  <link rel="shortcut icon" href="./fav.png" type="image/svg+xml">

  <!-- custom css link-->
  <link rel="stylesheet" href="./assets/css/style.css">

  <!-- swiper-bundle -->
  <link
      href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"
      rel="stylesheet"/>
    <link rel="stylesheet" href="./assets/css/swiper-bundle.min.css" />
    <script src="https://unpkg.com/boxicons@2.1.2/dist/boxicons.js"></script>

  <!--- google font link -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Oxanium:wght@600;700;800&family=Poppins:wght@400;500;600;700;800;900&display=swap"
    rel="stylesheet">
</head>

<body id="top">

  <!--HEADER Part-->

  <header class="header">

    <div class="header-top">
      <div class="container">

        <!-- <div class="countdown-text">
          Exclusive August flash sell Offer <span class="span skewBg">16</span> Days
        </div> -->
        <div class="countdown-text">
          <h3>Welcome to Shop </h3>
        </div>
        
        
        <!-- Follow us on -->
        <div class="social-wrapper">

          <p class="social-title">Follow us on :</p>

          <ul class="social-list">

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-facebook"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-twitter"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-pinterest"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-linkedin"></ion-icon>
              </a>
            </li>

          </ul>

        </div>

      </div>
    </div>
            <!-- NavBar part -->
<?php
    include 'navbar.php';
?>

  </header>

  <!---SEARCH BAR-->

  <div class="search-container" data-search-box>

    <div class="input-wrapper">
      <input type="search" name="search" aria-label="search" placeholder="Search here..." class="search-field">

      <button class="search-submit" aria-label="submit search" data-search-toggler>
        <ion-icon name="search-outline"></ion-icon>
      </button>

      <button class="search-close" aria-label="close search" data-search-toggler></button>
    </div>

  </div>
 <!---HERO PART-->
  <main>
    <article>

     

      <section class="section hero" id="home" aria-label="home"
        style="background-image: url('./assets/images/hero-bg.jpg')">
        <div class="container">

          <div class="hero-content">

            <p class="hero-subtitle">SURVIVAL ARENA</p>

            <h1 class="h1 hero-title">
              PREVAIL AGAINST ALL<span class="span">ODDS IN !</span> SURVIVAL ARENA
            </h1>

            <p class="hero-text">
              Build towers, formulate a strategy, ward off your enemies, and most importantly — survive!
            </p>

      

          </div>

          <figure class="hero-banner img-holder" style="--width: 700; --height: 700;">
            <img src="./assets/images/hero-banner.png" width="700" height="700" alt="hero banner" class="w-100">
          </figure>

        </div>
      </section>
      <!--BRAND PART-->

      <section class="section brand" aria-label="brand">
        <div class="container">

          <ul class="has-scrollbar">

            <li class="brand-item">
              <img src="./assets/images/brand-1.png" width="90" height="90" loading="lazy" alt="brand logo">
            </li>

            <li class="brand-item">
              <img src="./assets/images/brand-2.png" width="90" height="90" loading="lazy" alt="brand logo">
            </li>

            <li class="brand-item">
              <img src="./assets/images/brand-3.png" width="90" height="90" loading="lazy" alt="brand logo">
            </li>

            <li class="brand-item">
              <img src="./assets/images/brand-4.png" width="90" height="90" loading="lazy" alt="brand logo">
            </li>

            <li class="brand-item">
              <img src="./assets/images/brand-5.png" width="90" height="90" loading="lazy" alt="brand logo">
            </li>

            <li class="brand-item">
              <img src="./assets/images/brand-6.png" width="90" height="90" loading="lazy" alt="brand logo">
            </li>

          </ul>

        </div>
      </section>

    <br>
        <!---LIVE MATCH-->

        <?php
// Include the database configuration file to connect to the database
include 'config.php';  

// Fetch the live match URL from the database (assuming 'live_matches' table exists)
$query = "SELECT * FROM live_matches ORDER BY created_at DESC LIMIT 1"; // Adjust query as per your table structure
$result = $conn->query($query);

// If there is a live match URL in the database
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();  // Fetch the most recent live match details
    $liveMatchUrl = $row['match_url'];  // Assuming the column storing the URL is called 'match_url'
} else {
    $liveMatchUrl = '';  // If no live match URL exists, set it to an empty string
}

// Close the database connection
$conn->close();
?>

<!-- LIVE MATCH Section -->
<section class="section live-match" id="live" aria-label="live match">
    <div class="container">
        <h2 class="h2 section-title">
            Watch Live <span class="span">Match</span>
        </h2>

        <!-- Live Match Banner -->
        <figure class="live-match-banner img-holder" style="--width: 800; --height: 470;">
            <img src="./assets/images/live-match-banner.jpg" width="800" height="470" loading="lazy" alt="Live Match Video" class="img-cover">
            
            <?php if ($liveMatchUrl): ?>
                <!-- Show play button if live match URL exists -->
                <a href="<?php echo htmlspecialchars($liveMatchUrl); ?>" target="_blank" rel="noopener noreferrer">
                    <button class="play-btn" aria-label="play video">
                        <ion-icon name="play"></ion-icon>
                    </button>
                </a>
            <?php else: ?>
                <!-- If no live match is available, display this message -->
                <p>No live match available at the moment.</p>
            <?php endif; ?>
        </figure>
    </div>
</section>


      <!--GAMING PRODUCT CORNER-->

      <section class="section shop" id="shop" aria-label="shop"
    style="background-image: url('./assets/images/shop-bg.jpg')">
  <div class="container">

    <h2 class="h2 section-title">
      Gaming Product <span class="span">Corner</span>
    </h2>

    <p class="section-text">
      Price and other details may vary based on product size and color.
    </p>

    <ul class="has-scrollbar">
      <?php
        // Include database configuration
        include 'config.php';

        // Fetch products from the database
        $select_products = mysqli_query($conn, "SELECT * FROM `products`");
        if (mysqli_num_rows($select_products) > 0) {
          while ($product = mysqli_fetch_assoc($select_products)) {
            // Check if 'category' exists in the database result
            $category = isset($product['category']) ? htmlspecialchars($product['category']) : 'Unknown Category';

            // Generate product card dynamically
            echo '
            <li class="scrollbar-item">
              <div class="shop-card">
                <figure class="card-banner img-holder" style="--width: 300; --height: 260;">
                  <img src="data:image;base64,' . base64_encode($product['image']) . '" width="300" height="260" loading="lazy"
                    alt="' . htmlspecialchars($product['name']) . '" class="img-cover">
                </figure>
                <div class="card-content">
                  <a href="#" class="card-badge skewBg">' . $category . '</a>
                  <h3 class="h3">
                    <a href="#" class="card-title">' . htmlspecialchars($product['name']) . '</a>
                  </h3>
                  <div class="card-wrapper">
                    <p class="card-price">TK ' . htmlspecialchars($product['price']) . '</p>
                    <a href="shop.php" class="card-btn">
                      <ion-icon name="basket"></ion-icon>
                    </a>
                  </div>
                </div>
              </div>
            </li>';
          }
        } else {
          echo '<p>No products found</p>';
        }
      ?>
    </ul>

  </div>
</section>



<!--LATEST NEWS & ARTICLES-->

<?php
// Assuming your database connection is set up correctly
include 'config.php';  

try {
    // Fetch blog posts from the database
    $sql = "SELECT * FROM blogs ORDER BY date DESC LIMIT 3";  // Modify the query as needed
    $stmt = $conn->query($sql);

    // Check if the query executed successfully
    if ($stmt === false) {
        throw new Exception("Query failed: " . $conn->error);
    }

    // Fetch all blog posts using MySQLi's fetch_assoc
    $blogs = [];
    while ($row = $stmt->fetch_assoc()) {
        $blogs[] = $row;
    }

    if (empty($blogs)) {
        echo "No blog posts found.";
    }
} catch (mysqli_sql_exception $e) {
    echo "Error: " . $e->getMessage();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Blog Section</title>
  <link rel="stylesheet" href="admin.css" />
  <link href="https://cdn.jsdelivr.net/npm/ionicons@5.5.2/dist/ionicons/ionicons.css" rel="stylesheet" />
</head>

<body>
  <!-- Blog Section -->
  <section class="section blog" id="blog" aria-label="blog">
    <div class="container">
      <h2 class="h2 section-title">
        Latest News & <span class="span">Articles</span>
      </h2>

      <p class="section-text">
        The biggest video game news, rumors, previews, and info about PlayStation and Xbox.
      </p>

      <ul class="blog-list">
        <?php foreach ($blogs as $blog): ?>
          <li>
            <div class="blog-card">
              <figure class="card-banner img-holder" style="--width: 400; --height: 290;">
                <!-- If the image path contains 'assets/images/', strip it before appending again -->
                <?php 
                $imagePath = $blog['image'];
                if (strpos($imagePath, 'assets/images/') === 0) {
                    $imagePath = substr($imagePath, strlen('assets/images/')); // Remove the 'assets/images/' part
                }
                ?>
                <!-- Now render the image with the full path -->
                <img src="assets/images/<?php echo htmlspecialchars($imagePath); ?>" width="400" height="290" loading="lazy" alt="<?php echo htmlspecialchars($blog['title']); ?>" class="img-cover">
              </figure>

              <div class="card-content">
                <ul class="card-meta-list">
                  <li class="card-meta-item">
                    <ion-icon name="calendar-outline"></ion-icon>
                    <time datetime="<?php echo htmlspecialchars($blog['date']); ?>" class="item-text">
                      <?php echo date('F j, Y', strtotime($blog['date'])); ?>
                    </time>
                  </li>
                </ul>

                <h3>
                  <a href="#" class="card-title"><?php echo htmlspecialchars($blog['title']); ?></a>
                </h3>

                <p class="card-text">
                  <?php echo nl2br(htmlspecialchars(substr($blog['description'], 0, 150))); ?>...
                </p>

                <a href="<?php echo htmlspecialchars($blog['read_more_link']); ?>" class="card-link">
                  <span class="span">Read More</span>
                  <ion-icon name="caret-forward"></ion-icon>
                </a>

              </div>

            </div>
          </li>
        <?php endforeach; ?>
      </ul>

    </div>
  </section>
</body>
</html>





  </article>
  </main>



<br><br>

  <!--FOOTER-->

<?php
include "footer.php";
?>





  <!--BACK TO TOP-->

  <a href="#top" class="back-top-btn" aria-label="back to top" data-back-top-btn>
    <ion-icon name="caret-up"></ion-icon>
  </a>





  <!--custom js link
  -->
  <script src="./assets/js/script.js" defer></script>
  <script src="./assets/js/swiper-bundle.min.js"></script>
  <!-- <script src="./assets/js/tradingScript.js"></script> -->

  <!-- 
    -link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <script src="swiper-bundle.min.js"></script>
  
  <!-- <script src="script.js"></script> -->
  <script src="./assets/js/scriptTD.js"></script>
  <script src="./countDown.js"></script>

</body>

</html>