<?php
require_once "config.php";
require_once "ProductRepo.php";
require_once "ProductClass.php";
require_once "CartClass.php";

session_start();

// If no cart, nothing to process
if (!isset($_SESSION['cart'])) {
    header("Location: shop.php?order=empty");
    exit;
}

$cart = $_SESSION['cart'];
$items = $cart->getProducts();

// Connect to DB
$mysqli = db::getDB();
$productRepo = new ProductRepo($mysqli);

// Loop through each purchased product
foreach ($items as $id => $item) {
    /** @var ProductClass $product */
    $product  = $item['product'];
    $quantity = $item['quantity'];

    // Current stock
    $currentStock = $product->getStockQuantity();

    // New stock after purchase
    $newStock = max(0, $currentStock - $quantity);

    // Update DB
    $productRepo->updateProductStockQuantity($product->getId(), $newStock);
}

// Clear the cart
unset($_SESSION['cart']);

// Redirect back to shop with success flag
header("Location: shop.php?order=success");
exit;
?>
