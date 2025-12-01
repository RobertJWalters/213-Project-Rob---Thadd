<?php
require_once "config.php";
session_start();

$mysqli = db::getDB();

$email = trim($_POST['email']);
$pass  = $_POST['password'];

// Fetch user
$stmt = $mysqli->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 0) {
    $_SESSION['login_error'] = "Email not found.";
    header("Location: shop.php");
    exit;
}

$user = $res->fetch_assoc();

// Verify password
if (!password_verify($pass, $user['password_hash'])) {
    $_SESSION['login_error'] = "Incorrect password.";
    header("Location: shop.php");
    exit;
}

$_SESSION['user'] = $user; // store full row

//Find or create a cart for this user
$stmt = $mysqli->prepare("SELECT cart_id FROM carts WHERE user_id = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 0) {
    // Create new cart
    $stmt = $mysqli->prepare("INSERT INTO carts (user_id) VALUES (?)");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $cartId = $stmt->insert_id;
} else {
    $row = $res->fetch_assoc();
    $cartId = $row['cart_id'];
}

$_SESSION['cart_id'] = $cartId;

//Load cart items into session cart object
require_once "CartClass.php";
require_once "ProductClass.php";
require_once "ProductRepo.php";

$productRepo = new ProductRepo($mysqli);
$cart = new CartClass($email);

$stmt = $mysqli->prepare("SELECT product_id, quantity FROM cart_items WHERE cart_id = ?");
$stmt->bind_param("i", $cartId);
$stmt->execute();
$res = $stmt->get_result();

while ($row = $res->fetch_assoc()) {
    $product = $productRepo->findProductByID($row['product_id']);
    $cart->addProduct($product, $row['quantity']); // custom method below
}

$_SESSION['cart'] = $cart;

header("Location: shop.php");
exit;
