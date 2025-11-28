<?php

require_once "config.php";
session_start();

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $redirectTo = $_POST['redirect_to'] ?? 'dashboard.php';
    $id = $_POST['id'];
    $prodRepo = $_SESSION['prodRepo'];
    $success = true;

    if (!$prodRepo) {
        $success = false;
        die('ERROR on add_stock.php');
    }

    try {
        $prodRepo->delete($id);
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
