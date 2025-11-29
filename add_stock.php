<?php

require_once "config.php";
session_start();

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $redirectTo = $_POST['redirect_to'] ?? 'dashboard.php';
    $name = $_POST['name'] ?? null;
    $desc = $_POST['desc'] ?? null;
    $price = $_POST['price'] ?? null;
    $category = $_POST['category'] ?? null;
    $stockQuantity = $_POST['quantity'] ?? null;

    $success = true;


    try {
        $mysqli = db::getDB();
    } catch (Error $e) {
        $_SESSION['errors'] = ["Database connection failed: " . $e->getMessage()];
        header('Location: ' . $redirectTo);
        exit;
    }


    if ($mysqli === null) {
        echo "error";
        $success = false;
    } else {
        $prodRepo = new ProductRepo($mysqli);
        $data = $prodRepo->findAll();
        $_SESSION['productRepo'] = $prodRepo;
    }


    if (!$prodRepo) {
        $success = false;
        die('ERROR on add_stock.php');
    }
    try {
        $prodRepo->insertProduct($name, $desc, $price, $category, $stockQuantity);
    } catch (Exception $e) {
        echo $e->getMessage();
        echo 'ERROR on add_stock.php';
        $success = false;
    }

    if($success){
        header('Location: ' . $redirectTo);
        exit;
    }

}
?>