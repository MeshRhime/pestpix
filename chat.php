<?php
include('db/db.php');

// Handle chat messages
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = $_POST['message'];
    $sender_id = 1; // Replace with actual sender ID
    $recipient_id = 2; // Replace with actual recipient ID

    $sql = "INSERT INTO chats (sender_id, recipient_id, message) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$sender_id, $recipient_id, $message]);
}

// Fetch chat history
$sql = "SELECT * FROM chats WHERE sender_id = ? OR recipient_id = ? ORDER BY sent_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute([$sender_id, $sender_id]);
$chats = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chat with Users</title>
</head>
<body>
    <h1>Chat</h1>
    <form method="POST">
        <input type="text" name="message" placeholder="Type your message..." required>
        <button type="submit">Send</button>
    </form>

    <h2>Chat History</h2>
    <ul>
        <?php foreach ($chats as $chat): ?>
            <li><?php echo htmlspecialchars($chat['sender_id']); ?>: <?php echo htmlspecialchars($chat['message']); ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>