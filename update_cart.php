<?php
require_once "config.php";
session_start();

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $redirectTo = $_POST['redirect_to'] ?? 'cart.php';
    $action = $_POST['action'] ?? '';
    $productId = $_POST['id'] ?? null;
    $cartQty = $_POST['qty'] ?? null;
    $stockQty = $_POST['stock-qty'] ?? null;

    // Initialize cart if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = new CartClass(null);
    }

    $cart = $_SESSION['cart'];
    $products = $cart->getProducts();

    // Get the product object from the cart using the ID
    if (!isset($products[$productId])) {
        die('Product not found in cart');
    }

    $product = $products[$productId]['product'];  // This is the object

    try {
        if ($action === 'remove') {
            $cart->removeProduct($product);
            $_SESSION['cart'] = $cart;
        } elseif ($action === 'increase' && $stockQty > $cartQty) {
            $cart->addProduct($product);
            $_SESSION['cart'] = $cart;
        } elseif ($action === 'decrease') {
            $cart->decreaseProductQty($product);
            $_SESSION['cart'] = $cart;
        }
        //if user logged in, write cart to db
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    header('Location: ' . $redirectTo);
    exit;
}else{
    echo "ERROR on update_cart.php ";
}
?>