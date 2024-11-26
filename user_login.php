<?php
// Include the database connection
require 'db/db.php'; // Ensure this file contains the PDO connection

session_start(); // Start the session to manage user login status

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the username and password from the form
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        // Prepare the query to check if the user exists
        $query = $pdo->prepare("SELECT id, password FROM users WHERE username = ? AND role = 'user'");
        $query->execute([$username]);
        
        // Fetch the user data
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Store user ID or other relevant details in the session
                $_SESSION['user_id'] = $user['id'];

                // Redirect to the user dashboard
                header("Location: user_dashboard.php");
                exit;
            } else {
                $error = "Invalid password. Please try again.";
            }
        } else {
            $error = "Invalid username or user does not exist.";
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
    <title>User Login</title>
    <link rel="stylesheet" href="assets/css/user.css"> <!-- External CSS -->
</head>
<body>
    <div class="header">
        <div class="logo">
            <img alt="Logo" src="assets/img/logo.png"/>
            <div class="title">PESTPIX: Farmerce System</div>
        </div>
    </div>

    <div class="container">
        <h1>Login as User</h1>
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
