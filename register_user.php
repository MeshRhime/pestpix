<?php
require 'db/db.php';

if (isset($_POST['register_user'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validate that passwords match
    if ($password !== $confirm_password) {
        die('Passwords do not match!');
    }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    try {
        // Insert user into the database
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, 'user')");
        $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => $hashed_password,
        ]);
        echo "User registered successfully!";
        // Redirect to user dashboard
        header('Location: user_dashboard.php');
    } catch (PDOException $e) {
        if ($e->getCode() === '23000') { // Duplicate email error
            die('Email already exists!');
        }
        die('Error: ' . $e->getMessage());
    }
}
?>
