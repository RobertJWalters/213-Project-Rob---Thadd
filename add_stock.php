<?php
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $redirectTo = $_POST['redirect_to'] ?? 'dashboard.php';

    $repo = $_SESSION['repo'] ?? null;



    header('Location: ' . $redirectTo);
    exit;
}
?>