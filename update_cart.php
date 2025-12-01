<?php
require_once "config.php";
require_once "CartClass.php";
require_once "ProductRepo.php";
session_start();

$redirect = $_POST['redirect_to'] ?? "cart.php";
$productId = $_POST['id'];
$action    = $_POST['action'];
$cartQty = $_POST['qty'] ?? null;
$stockQty = $_POST['stock-qty'] ?? null;

$mysqli = db::getDB();
$productRepo = new ProductRepo($mysqli);

$product = $productRepo->findProductByID($productId);

$cart = $_SESSION['cart'];

// session update
if  ($action === 'increase' && $stockQty > $cartQty) {
    $cart->addProduct($product);
} else if ($action === "decrease") {
    $cart->decreaseProductQty($product);
} else if ($action === "remove") {
    $cart->removeProduct($product);
}

// DB update if logged in
if (isset($_SESSION['user'])) {
    $cart_id = $_SESSION['cart_id'];

    if ($action === "increase") {
        $stmt = $mysqli->prepare("UPDATE cart_items SET quantity = quantity + 1
                                  WHERE cart_id = ? AND product_id = ?");
        $stmt->bind_param("ii", $cart_id, $productId);
        $stmt->execute();
    }

    if ($action === "decrease") {
        // check current qty
        $stmt = $mysqli->prepare("SELECT quantity FROM cart_items WHERE cart_id = ? AND product_id = ?");
        $stmt->bind_param("ii", $cart_id, $productId);
        $stmt->execute();
        $qty = $stmt->get_result()->fetch_assoc()['quantity'];

        if ($qty <= 1) {
            // remove
            $stmt = $mysqli->prepare("DELETE FROM cart_items WHERE cart_id = ? AND product_id = ?");
            $stmt->bind_param("ii", $cart_id, $productId);
            $stmt->execute();
        } else {
            $stmt = $mysqli->prepare("UPDATE cart_items SET quantity = quantity - 1
                                      WHERE cart_id = ? AND product_id = ?");
            $stmt->bind_param("ii", $cart_id, $productId);
            $stmt->execute();
        }
    }

    if ($action === "remove") {
        $stmt = $mysqli->prepare("DELETE FROM cart_items WHERE cart_id = ? AND product_id = ?");
        $stmt->bind_param("ii", $cart_id, $productId);
        $stmt->execute();
    }
}

$_SESSION['cart'] = $cart;

header("Location: $redirect");
exit;
