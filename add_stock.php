<?php
ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL);

require_once "config.php";
session_start();

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $redirectTo = $_POST['redirect_to'] ?? 'dashboard.php';
//    $id = $_POST['id'] ?? null;
    $name = $_POST['name'] ?? null;
    $desc = $_POST['desc'] ?? null;
    $price = $_POST['price'] ?? null;
    $category = $_POST['category'] ?? null;
    $stockQuantity = $_POST['quantity'] ?? null;

    $success = true;


    // some error tests
    $errors = [];
//    if (empty($id)) $errors[] = "ID is required";
    if (empty($name)) $errors[] = "Name is required";
    if (empty($price)) $errors[] = "Price is required";
    if (empty($category)) $errors[] = "Category is required";
    if (empty($stockQuantity)) $errors[] = "Quantity is required";


    try {
        $mysqli = db::getDB();
    } catch (Error $e) {
        $_SESSION['errors'] = ["Database connection failed: " . $e->getMessage()];
        header('Location: ' . $redirectTo);
        exit;
    }

// Fallback to array database if no connection just for testing, make sure to DELETE
    if ($mysqli === null) {
        echo "error";
        $success = false;
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
foreach($errors as $error){
    echo $error;
}
echo "error on add_stock.php ";
?>