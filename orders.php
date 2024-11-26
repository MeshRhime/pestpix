<?php
include('db/db.php');

// Fetch orders from the database
$sql = "SELECT o.*, p.name AS product_name FROM orders o JOIN products p ON o.product_id = p.id WHERE o.shop_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([1]); // Replace '1' with actual shop_id
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Orders</title>
</head>
<body>
    <h1>Your Orders</h1>
    <ul>
        <?php foreach ($orders as $order): ?>
            <li>
                Order #<?php echo htmlspecialchars($order['id']); ?> - Status: <?php echo htmlspecialchars($order['status']); ?>
                <div>Product: <?php echo htmlspecialchars($order['product_name']); ?></div>
                <div>Quantity: <?php echo htmlspecialchars($order['quantity']); ?></div>
                <div>Total Price: ₱<?php echo htmlspecialchars($order['total_price']); ?></div>
            </li>
        <?php endforeach; ?>
 </ul>
</body>
</html>