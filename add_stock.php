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

    $productRepo = $_SESSION['productRepo'] ?? null;

    if (!$productRepo) {
        die('ERROR on add_stock.php');
    }
    try {
        $productRepo->insertProduct($id, $name, $desc, $price, $category, $stockQuantity);
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    header('Location: ' . $redirectTo);
    exit;
}
?>