<?php
// Include the database connection (if needed)
include('db/db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard</title>
    <!-- Link to external CSS file -->
    <link rel="stylesheet" href="assets/css/s.css">
</head>
<body>
    <div class="header">
        <div class="profile-icon">
            <img src="assets/img/user.png" alt="Profile Icon">
        </div>
        <div class="menu">
            <button class="menu-button">
                <img src="assets/img/dots.png" alt="Menu Icon">
            </button>
        </div>
    </div>
    <div class="content">
        <h1>Welcome, Seller!</h1>
        
        <div class="card">
            <h2>Recent Orders</h2>
            <div class="order-list">
                <div class="order-item">
                    <div>
                        <div class="order-name">Order #1234</div>
                        <div class="order-date">Oct 7, 2024</div>
                    </div>
                    <div class="order-status">Shipped</div>
                </div>
                <div class="order-item">
                    <div>
                        <div class="order-name">Order #1235</div>
                        <div class="order-date">Oct 6, 2024</div>
                    </div>
                    <div class="order-status">Processing</div>
                </div>
                <div class="order-item">
                    <div>
                        <div class="order-name">Order #1236</div>
                        <div class="order-date">Oct 5, 2024</div>
                    </div>
                    <div class="order-status">Delivered</div>
                </div>
            </div>
        </div>
        
        <div class="card">
            <h2>Shop</h2>
            <div class="shop-list">
                <div class="shop-item">
                    <div class="shop-image">80 x 80</div>
                    <div>
                        <div class="shop-name">Insecticide A</div>
                        <div class="shop-price">₱250.00</div>
                    </div>
                </div>
                <div class="shop-item">
                    <div class="shop-image">80 x 80</div>
                    <div>
                        <div class="shop-name">Organic Spray B</div>
                        <div class="shop-price">₱250.00</div>
                    </div>
                </div>
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
    
    <!-- Footer with icons -->
    <div class="footer">
        <a href="seller_dashboard.php" class="icon-button">
            <img src="assets/img/home.png" alt="Home Icon">
        </a>
        <a href="models/shop.php" class="icon-button">
            <img src="assets/img/cart.png" alt="Orders Icon">
        </a>
        <a href="products.php" class="icon-button">
            <img src="assets/img/shop.png" alt="My Shop Icon">
        </a>
        <a href="models/cam.php" class="icon-button">
            <img src="assets/img/mail.png" alt="Chat Icon">
        </a>
        <a href="models/s-set.php" class="icon-button">
            <img src="assets/img/settings.png" alt="Settings Icon">
        </a>
    </div>
</body>
</html>