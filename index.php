<?php
// Include the database connection
require 'db/db.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome Page</title>
    <!-- Link to the external CSS file -->
    <link rel="stylesheet" href="assets/css/index.css">
</head>
<body>
    <div class="header">
        <div class="logo">
            <img alt="Logo" src="assets/img/logo.png"/>
            <div class="title">
                PESTPIX: Farmerce System
            </div>
        </div>
    </div>
    
    <div class="container">
        <h1>Welcome</h1>
        <a class="button" href="seller_login.php">Login as Seller</a>
        <a class="button" href="user_login.php">Login as User</a>
        <a class="button" href="create.php">Create Account</a>
    </div>
    
    <div class="footer">
        <div class="logo">
            &copy; 2024 PESTPIX: Farmerce System
        </div>
    </div>
</body>
</html>
