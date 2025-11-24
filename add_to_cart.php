<?php
require_once "config.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['product_id'] ?? null;
    $redirectTo = $_POST['redirect_to'] ?? 'shop.php';

    if (!$productId) {
        die('No product ID');
    }

    // Initialize cart if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = new CartClass(null);
    }

    // Get the product from session
    $product = $_SESSION['productItem'];

    if (!$product) {
        die('Product not found');
    }

    // Add to cart
    $cart = $_SESSION['cart'];
    $cart->addProduct($product);
    $_SESSION['cart'] = $cart;

    error_log('Cart saved: ' . count($_SESSION['cart']->getProducts()) . ' items');
    header('Location: ' . $redirectTo);
    exit;
}
?>
