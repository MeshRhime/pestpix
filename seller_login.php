<?php
// Include the database connection
require 'db/db.php';
session_start(); // Start session to manage seller data

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the username and password from the form
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        // Prepare the query to check if the seller exists
        $query = $pdo->prepare("SELECT id, password FROM users WHERE username = ? AND role = 'seller'");
        $query->execute([$username]);
        
        // Fetch the seller data
        $seller = $query->fetch(PDO::FETCH_ASSOC);

        if ($seller) {
            // Verify the password
            if (password_verify($password, $seller['password'])) {
                // Store seller ID or other relevant details in the session
                $_SESSION['seller_id'] = $seller['id'];

                // Redirect to the seller dashboard
                header("Location: seller_dashboard.php");
                exit;
            } else {
                $error = "Invalid password. Please try again.";
            }
        } else {
            $error = "Invalid username or seller does not exist.";
        }
    } else {
        $error = "Please fill in all the fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Login</title>
    <link rel="stylesheet" href="assets/css/seller.css"> <!-- External CSS -->
</head>
<body>
    <div class="header">
        <div class="logo">
            <img alt="Logo" src="assets/img/logo.png"/>
            <div class="title">PESTPIX: Farmerce System</div>
        </div>
    </div>

    <div class="container">
        <h1>Login as Seller</h1>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="post" action="">
            <input class="input-field" name="username" placeholder="Username" type="text" required />
            <input class="input-field" name="password" placeholder="Password" type="password" required />
            <button class="button" type="submit">Login</button>
        </form>
    </div>

    <div class="footer">
        <div class="logo">&copy; 2024 PESTPIX: Farmerce System</div>
    </div>
</body>
</html>
