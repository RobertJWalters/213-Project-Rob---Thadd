<?php

require_once "config.php";
session_start();

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $redirectTo = $_POST['redirect_to'] ?? 'shop.php';

    // Initialize cart if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = new CartClass(null);
    }

    // Get the product from session
    $product = $_SESSION['productItem'] ?? null;

    if (!$product) {
        die('Product not found');
    }

    // Add to cart
    $cart = $_SESSION['cart'];
    try {
        $cart->addProduct($product);
        $_SESSION['cart'] = $cart;

    } catch (Exception $e) {
        echo $e->getMessage();
    }

    header('Location: ' . $redirectTo);
    exit;
}
?>