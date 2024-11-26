<?php
// Database connection configuration
$host = 'mysql_db'; // Container name of the MySQL service in Docker
$dbname = 'pest'; // Name of your database
$username = 'root'; // MySQL root user
$password = 'root'; // MySQL root password

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // If there is an error, display it and exit
    die("Database connection failed: " . $e->getMessage());
}
?>
