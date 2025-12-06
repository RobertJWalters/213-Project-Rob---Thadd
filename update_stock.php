<?php
// AI tools were used during development to assist developers
// Robert Walters
require_once "config.php";
session_start();

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $redirectTo = $_POST['redirect_to'] ?? 'dashboard.php';
    $action = $_POST['action'] ?? '';
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];
    $success = true;

    //Attempt to establish database connection
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
    } else {  // Initialize ProductRepo with database connection
        $prodRepo = new ProductRepo($mysqli);
        $data = $prodRepo->findAll();
        $_SESSION['productRepo'] = $prodRepo;
    }

    if (!$prodRepo) {
        $success = false;
        die('ERROR on update_stock.php');
    }

    $errors = [];
    if (empty($id)) $errors[] = "ID is required";
    if (empty($quantity)) $errors[] = "quantity is required";


    try {
        if ($action === 'increase') {
            $prodRepo->updateProductStockQuantity($id, $quantity + 1);
        } elseif ($action === 'decrease') {
            $prodRepo->updateProductStockQuantity($id, $quantity - 1);
        }

    } catch (Exception $e) {
        echo $e->getMessage();
        echo 'ERROR on update_stock.php';
        $success = false;
    }

    if ($success) {
        header('Location: ' . $redirectTo);
        exit;
    }
}
foreach ($errors as $error) {
    echo $error;
}