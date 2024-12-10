<?php
include_once 'config.php';

function getAllProducts($pdo) {
    $stmt = $pdo->prepare("SELECT * FROM products");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addProduct($pdo, $name, $category, $price, $stock, $image) {
    $stmt = $pdo->prepare("INSERT INTO products (name, category, price, stock, image) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$name, $category, $price, $stock, $image]);
}

function updateProduct($pdo, $id, $name, $category, $price, $stock, $image) {
    $stmt = $pdo->prepare("UPDATE products SET name = ?, category = ?, price = ?, stock = ?, image = ? WHERE id = ?");
    $stmt->execute([$name, $category, $price, $stock, $image, $id]);
}

function deleteProduct($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$id]);
}
?>