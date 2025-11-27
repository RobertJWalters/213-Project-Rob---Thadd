<?php
session_start();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = htmlspecialchars(trim($_POST['email']));
    $password = $_POST['password'];

    $users = json_decode(file_get_contents('users.json'), true);

    $found = null;
    foreach ($users as $u) {
        if ($u['email'] === $email) {
            $found = $u;
            break;
        }
    }

    if (!$found || !password_verify($password, $found['password'])) {
        $_SESSION['login_error'] = 'Invalid email or password.';
        header('Location: shop.php');
        exit;
    }

    $_SESSION['user'] = [
        'email' => $found['email'],
        'name'  => $found['name']
    ];

    header('Location: shop.php');
    exit;
}
?>
