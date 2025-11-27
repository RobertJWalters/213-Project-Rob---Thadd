<?php

require_once "config.php";
session_start();

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $redirectTo = $_POST['redirect_to'] ?? 'dashboard.php';
    $id = $_POST['id'] ?? null;
    $name = $_POST['name'] ?? null;
    $desc = $_POST['desc'] ?? null;
    $price = $_POST['price'] ?? null;
    $category = $_POST['category'] ?? null;
    $stockQuantity = $_POST['quantity'] ?? null;


    try {
        $mysqli = db::getDB();
    } catch (Error $e) {
        $mysqli = null;
    }

// Fallback to array database if no connection just for testing, make sure to DELETE
    if ($mysqli === null) {
        echo "error";
    } else {
        $prodRepo = new ProductRepo($mysqli);
        $data = $prodRepo->findAll();
        $_SESSION['productRepo'] = $prodRepo;
    }

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = new CartClass(null);
    }
//
//    $productRepo = $_SESSION['productRepo'] ?? null;

    if (!$prodRepo) {
        die('ERROR on add_stock.php');
    }
    try {
        $prodRepo->insertProduct($id, $name, $desc, $price, $category, $stockQuantity);
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    header('Location: ' . $redirectTo);
    exit;
}
?>