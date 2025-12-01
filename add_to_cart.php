<?php
require_once "config.php";
require_once "CartClass.php";
require_once "ProductClass.php";
require_once "ProductRepo.php";
session_start();

$redirect = $_POST['redirect_to'] ?? "shop.php";

if (!isset($_SESSION['productItem'])) {
    die("Item missing.");
}

$product = $_SESSION['productItem'];

// add to session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = new CartClass(null);
}

$cart = $_SESSION['cart'];
$cart->addProduct($product);

// 🔥 If logged in, write to DB
if (isset($_SESSION['user'])) {
    $cart_id = $_SESSION['cart_id'];
    $mysqli  = db::getDB();

    // check if row exists
    $stmt = $mysqli->prepare("SELECT quantity FROM cart_items WHERE cart_id = ? AND product_id = ?");
    $stmt->bind_param("ii", $cart_id, $product->getId());
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        // update quantity
        $stmt = $mysqli->prepare("UPDATE cart_items SET quantity = quantity + 1 
                                  WHERE cart_id = ? AND product_id = ?");
        $stmt->bind_param("ii", $cart_id, $product->getId());
    } else {
        // insert new row
        $stmt = $mysqli->prepare("INSERT INTO cart_items (cart_id, product_id, quantity)
                                  VALUES (?, ?, 1)");
        $stmt->bind_param("ii", $cart_id, $product->getId());
    }

    $stmt->execute();
}

header("Location: $redirect");
exit;
