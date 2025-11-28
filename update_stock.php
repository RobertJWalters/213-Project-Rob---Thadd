<?php
ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL);
require_once "config.php";
session_start();

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $redirectTo = $_POST['redirect_to'] ?? 'dashboard.php';
    $action = $_POST['action'] ?? '';
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];
    $prodRepo = $_SESSION['prodRepo'];
    $success = true;

    if (!$prodRepo) {
        $success = false;
        die('ERROR on add_stock.php');
    }

    $errors = [];
    if (empty($id)) $errors[] = "ID is required";
    if (empty($quantity)) $errors[] = "quantity is required";


        try {
           if ($action === 'increase') {
               $prodRepo->updateProductStockQuantity($id, $quantity + 1);
            } elseif ($action === 'decrease') {
               $prodRepo->updateProductStockQuantity($id, $quantity + 1);
           }

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
foreach($errors as $error){
    echo $error;
}