<?php
// AI tools were used during development to assist developers
// Robert Walters
require_once "config.php";
session_start();

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $redirectTo = $_POST['redirect_to'] ?? 'dashboard.php';
    // Retrieve product information from POST request
    $name = $_POST['name'] ?? null;
    $desc = $_POST['desc'] ?? null;
    $price = $_POST['price'] ?? null;
    $category = $_POST['category'] ?? null;
    $stockQuantity = $_POST['quantity'] ?? null;

    $success = true;

    // Attempt to establish database connection
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
        // Initialize ProductRepo with database connection
        $prodRepo = new ProductRepo($mysqli);
        $data = $prodRepo->findAll();
        $_SESSION['productRepo'] = $prodRepo;
    }


    if (!$prodRepo) {
        $success = false;
        die('ERROR on add_stock.php');
    } // Attempt to insert the new product into the database
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