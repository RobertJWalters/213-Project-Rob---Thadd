<?php
ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL);
require_once "config.php";
session_start();

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $redirectTo = $_POST['redirect_to'] ?? 'dashboard.php';
    $id = $_POST['id'];
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

    $errors = [];
    if (empty($id)) $errors[] = "ID is required";

    if (!$prodRepo) {
        $success = false;
        die('ERROR on delete_stock.php');
    }

    try {
        $prodRepo->delete($id);
    } catch (Exception $e) {
        echo $e->getMessage();
        echo 'ERROR on delete_stock.php';
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