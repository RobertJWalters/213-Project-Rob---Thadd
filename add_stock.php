<?php
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $redirectTo = $_POST['redirect_to'] ?? 'dashboard.php';

    $productRepo = $_SESSION['productRepo'] ?? null;



    header('Location: ' . $redirectTo);
    exit;
}
?>