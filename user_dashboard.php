<?php
// Include the database connection
include('db/db.php'); // This includes the $pdo object for database connection
?>
<!DOCTYPE html>
<html>
<head>
    <title>Farmer Dashboard</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
    <div class="header">
        <!-- Keep the profile icon as a regular image, no button -->
        <div class="profile-icon">
            <img src="assets/img/user.png" alt="Profile Icon">
        </div>
        <div class="menu">
            <div class="cart-icon">
                <button class="icon-button">
                    <img src="assets/img/car.png" alt="Cart Icon">
                </button>
            </div>
            <div class="menu-icon">
                <button class="icon-button">
                    <img src="assets/img/dots.png" alt="Menu Icon">
                </button>
            </div>
        </div>
    </div>
    <div class="content">
        <h1>Welcome, Farmer!</h1>
        <div class="card">
            <div class="icons">
                <button class="icon-button">
                    <img src="assets/img/mail.png" alt="Chat Icon">
                </button>
                <button class="icon-button">
                    <img src="assets/img/clock.png" alt="History Icon">
                </button>
                <button class="icon-button">
                    <img src="assets/img/seed.png" alt="Farm Icon">
                </button>
                <button class="icon-button">
                    <img src="assets/img/shop.png" alt="Shop Icon">
                </button>
            </div>
        </div>
        <div class="card">
            <h2>Recent Pest Identifications</h2>
            <div class="pest-list">
                <?php
                try {
                    // Query the database for recent pest identifications using PDO
                    $query = "SELECT * FROM pests ORDER BY identification_date DESC LIMIT 3";
                    $stmt = $pdo->prepare($query); // Prepare the query
                    $stmt->execute(); // Execute the query

                    // Fetch the results
                    $pests = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch results as associative array

                    if ($pests) {
                        foreach ($pests as $row) {
                            echo '<div class="pest-item">';
                            echo '<div>';
                            echo '<div class="pest-name">' . htmlspecialchars($row['pest_name']) . '</div>';
                            echo '<div class="pest-date">' . htmlspecialchars($row['identification_date']) . '</div>';
                            echo '</div>';
                            echo '<div class="pest-percentage">' . htmlspecialchars($row['identification_percentage']) . '%</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>No pest identifications found.</p>';
                    }
                } catch (PDOException $e) {
                    echo 'Error fetching pests: ' . $e->getMessage();
                }
                ?>
            </div>
        </div>
        <div class="card">
            <h2>Shop</h2>
            <div class="shop-list">
                <?php
                try {
                    // Query the database for shop items using PDO
                    $query = "SELECT * FROM shop_items ORDER BY item_name ASC";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute();

                    // Fetch the results
                    $shop_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if ($shop_items) {
                        foreach ($shop_items as $row) {
                            echo '<div class="shop-item">';
                            echo '<div class="shop-image"><img src="' . htmlspecialchars($row['image_url']) . '" alt="' . htmlspecialchars($row['item_name']) . '" width="80" height="80"></div>';
                            echo '<div>';
                            echo '<div class="shop-name">' . htmlspecialchars($row['item_name']) . '</div>';
                            echo '<div class="shop-price">₱' . number_format($row['price'], 2) . '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>No items available in the shop.</p>';
                    }
                } catch (PDOException $e) {
                    echo 'Error fetching shop items: ' . $e->getMessage();
                }
                ?>
            </div>
        </div>
        <div class="card">
            <h2>Notifications</h2>
            <div class="notifications">
                <div class="notification-item">
                    <div class="notification-text">New treatment guide available for Aphids.</div>
                    <div class="notification-time">9:00 AM</div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <button class="icon-button">
            <img src="assets/img/home.png" alt="Home Icon">
        </button>
        <button class="icon-button">
            <img src="assets/img/shop.png" alt="Shop Icon">
        </button>
        <div class="camera-icon">
            <button class="icon-button">
                <img src="assets/img/cam.png" alt="Camera Icon">
            </button>
        </div>
        <button class="icon-button">
            <img src="assets/img/seed.png" alt="Farm Icon">
        </button>
        <button class="icon-button">
            <img src="assets/img/settings.png" alt="Settings Icon">
        </button>
    </div>
</body>
</html>
