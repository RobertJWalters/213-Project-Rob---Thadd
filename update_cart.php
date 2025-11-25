<?php
require_once "config.php";
session_start();

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $redirectTo = $_POST['redirect_to'] ?? 'cart.php';
    $action = $_POST['action'] ?? '';
    $productId = $_POST['product_id'] ?? null;

    // Initialize cart if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = new CartClass(null);
    }

    $product = null;

    $cart = $_SESSION['cart'];
    try {

    foreach ($cart as $productId => $productItem) {
        if($productItem['product']->getId() === $productId) {
            $product = $productItem;
        }
    }

    if (!$product) {
        die('update fail');
    }




        if ($action === 'remove') {
            $cart->removeProduct($product);
            $_SESSION['cart'] = $cart;
        } elseif ($action === 'increase') {
            $cart->addProduct($product);
            $_SESSION['cart'] = $cart;
        } elseif ($action === 'decrease') {
            $cart->decreaseProductQty($product);
            $_SESSION['cart'] = $cart;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    header('Location: ' . $redirectTo);
    exit;
}
?>