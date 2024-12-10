<?php
include_once 'config.php';

// Fetch all products
function getAllProducts($pdo) {
    $query = "SELECT p.id, p.name, c.name AS category, p.price, p.stock, p.image 
              FROM products p
              JOIN categories c ON p.category = c.id";
    $stmt = $pdo->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Add a new product
function addProduct($pdo, $name, $category, $price, $stock, $image) {
    $stmt = $pdo->prepare("INSERT INTO products (name, category, price, stock, image) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$name, $category, $price, $stock, $image]);
}

// Update product details
function updateProduct($pdo, $id, $name, $category, $price, $stock, $image) {
    $stmt = $pdo->prepare("UPDATE products SET name = ?, category = ?, price = ?, stock = ?, image = ? WHERE id = ?");
    $stmt->execute([$name, $category, $price, $stock, $image, $id]);
}

// Delete a product
function deleteProduct($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$id]);
}

// Fetch all orders
function getAllOrders($pdo) {
    $stmt = $pdo->prepare("SELECT * FROM orders");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Add an order
function addOrder($pdo, $userId, $total) {
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, total) VALUES (?, ?)");
    $stmt->execute([$userId, $total]);
    return $pdo->lastInsertId();
}

// Add items to an order
function addOrderItem($pdo, $orderId, $productId, $quantity, $price) {
    $stmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
    $stmt->execute([$orderId, $productId, $quantity, $price]);
}
?>
