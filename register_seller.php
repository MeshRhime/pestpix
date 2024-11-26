<?php 
require 'db/db.php';

if (isset($_POST['register_seller'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validate password match
    if ($password !== $confirm_password) {
        die('Passwords do not match!');
    }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    try {
        // Insert seller into the database
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, 'seller')");
        $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => $hashed_password,
        ]);
        
        // Redirect to the seller dashboard
        header('Location: seller_dashboard.php');
        exit; // Make sure to exit after the redirect to avoid further script execution

    } catch (PDOException $e) {
        if ($e->getCode() === '23000') { // Duplicate email error
            die('Email already exists!');
        }
        die('Error: ' . $e->getMessage());
    }
}
?>
