<?php
// Include the database connection
include('db/db.php');

// Fetch the shop ID of the logged-in seller (adjust as needed based on your session logic)
$shop_id = 1; // Example: Replace with the actual shop ID for the logged-in seller.

// Handle form submission for adding, editing, and deleting products
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle Add/Edit
    if (isset($_POST['action']) && ($_POST['action'] == 'add' || $_POST['action'] == 'edit')) {
        $productName = $_POST['product_name'];
        $productPrice = $_POST['product_price'];
        $productQuantity = $_POST['product_quantity'];
        $productId = $_POST['product_id'] ?? null;

        // Handle image upload
        if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == UPLOAD_ERR_OK) {
            $imageName = $_FILES['product_image']['name'];
            $imageTmpName = $_FILES['product_image']['tmp_name'];
            $imageFolder = 'uploads/' . $imageName;

            if (move_uploaded_file($imageTmpName, $imageFolder)) {
                if ($_POST['action'] == 'edit' && !empty($_POST['old_image'])) {
                    unlink($_POST['old_image']);
                }
            } else {
                $imageFolder = $_POST['old_image'] ?? null;
            }
        } else {
            $imageFolder = $_POST['old_image'] ?? null;
        }

        try {
            if ($_POST['action'] == 'add') {
                // Insert product into database using PDO
                $query = "INSERT INTO products (shop_id, name, price, quantity, image_url) 
                          VALUES (:shop_id, :product_name, :product_price, :product_quantity, :image_url)";
                $stmt = $pdo->prepare($query);
                $stmt->execute([
                    ':shop_id' => $shop_id,
                    ':product_name' => $productName,
                    ':product_price' => $productPrice,
                    ':product_quantity' => $productQuantity,
                    ':image_url' => $imageFolder
                ]);
            } elseif ($_POST['action'] == 'edit' && $productId) {
                // Update product in database using PDO
                $query = "UPDATE products SET name=:product_name, price=:product_price, quantity=:product_quantity, image_url=:image_url 
                          WHERE id=:product_id AND shop_id=:shop_id";
                $stmt = $pdo->prepare($query);
                $stmt->execute([
                    ':product_name' => $productName,
                    ':product_price' => $productPrice,
                    ':product_quantity' => $productQuantity,
                    ':image_url' => $imageFolder,
                    ':product_id' => $productId,
                    ':shop_id' => $shop_id
                ]);
            }
        } catch (PDOException $e) {
            // Handle any errors during database operation
            echo "Error: " . $e->getMessage();
        }
    }

    // Handle Delete
    if (isset($_POST['action']) && $_POST['action'] == 'delete' && isset($_POST['product_id'])) {
        $productId = $_POST['product_id'];

        try {
            // Fetch product image URL before deletion
            $query = "SELECT image_url FROM products WHERE id=:product_id AND shop_id=:shop_id";
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                ':product_id' => $productId,
                ':shop_id' => $shop_id
            ]);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($product && file_exists($product['image_url'])) {
                unlink($product['image_url']); // Delete the image file
            }

            // Delete product from the database
            $query = "DELETE FROM products WHERE id=:product_id AND shop_id=:shop_id";
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                ':product_id' => $productId,
                ':shop_id' => $shop_id
            ]);
        } catch (PDOException $e) {
            // Handle any errors during database operation
            echo "Error: " . $e->getMessage();
        }
    }
}

// Fetch all products for the shop
try {
    $query = "SELECT * FROM products WHERE shop_id=:shop_id";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':shop_id' => $shop_id]);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Management</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Header -->
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

    <!-- Product Management Section -->
    <div class="content">
        <h1>Manage Products</h1>
        <div class="card">
            <form class="product-form" action="" method="POST" enctype="multipart/form-data">
                <div>
                    <label for="product_name">Product Name:</label>
                    <input type="text" id="product_name" name="product_name" required>
                </div>
                <div>
                    <label for="product_price">Price:</label>
                    <input type="number" id="product_price" name="product_price" required>
                </div>
                <div>
                    <label for="product_quantity">Quantity:</label>
                    <input type="number" id="product_quantity" name="product_quantity" required>
                </div>
                <div>
                    <label for="product_image">Image:</label>
                    <input type="file" id="product_image" name="product_image">
                </div>
                <input type="hidden" name="product_id" id="product_id">
                <input type="hidden" name="old_image" id="old_image">
                <input type="hidden" name="action" id="action" value="add">
                <button type="submit">Add Product</button>
            </form>
            <h2>Product List</h2>
            <table class="product-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product) { ?>
                    <tr>
                        <td><?php echo $product['id']; ?></td>
                        <td>
                            <div class="product-image">
                                <img src="<?php echo $product['image_url']; ?>" alt="Product Image" width="50" height="50">
                            </div>
                        </td>
                        <td><?php echo $product['name']; ?></td>
                        <td>₱<?php echo $product['price']; ?></td>
                        <td><?php echo $product['quantity']; ?></td>
                        <td class="product-actions">
                            <form action="" method="POST" style="display: inline;">
                                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                <input type="hidden" name="action" value="delete">
                                <button type="submit">Delete</button>
                            </form>
                            <button onclick="editProduct(<?php echo htmlspecialchars(json_encode($product)); ?>)">Edit</button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer -->
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

    <script>
        function editProduct(product) {
            document.getElementById('product_id').value = product.id;
            document.getElementById('product_name').value = product.name;
            document.getElementById('product_price').value = product.price;
            document.getElementById('product_quantity').value = product.quantity;
            document.getElementById('old_image').value = product.image_url;
            document.getElementById('action').value = 'edit';
        }
    </script>
</body>
</html>