<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['product_id'] ?? null;
    $redirectTo = $_POST['redirect_to'] ?? 'shop.php';

    if (!$productId) {
        die('No product ID');
    }

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $_SESSION['cart'][] = [
        'product_id' => $productId,
        'quantity' => 1
    ];

    header('Location: ' . $redirectTo);
    exit;
}
?>