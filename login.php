<?php
// AI tools were used during development to assist developers
// Thadd McLeod
require_once "config.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    $mysqli = db::getDB();

    // --- Fetch user ---
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows === 0) {
        $_SESSION["login_error"] = "Email not found.";
        header("Location: shop.php");
        exit;
    }

    $user = $res->fetch_assoc();

    // --- Verify password ---
    if (!password_verify($password, $user["password_hash"])) {
        $_SESSION["login_error"] = "Incorrect password.";
        header("Location: shop.php");
        exit;
    }

    // --- Store user session ---
    $_SESSION["user"] = [
        "email" => $user["email"],
        "name"  => $user["name"]
    ];

    // --- ADMIN REDIRECT ---
    if ($email === "admin@rhad.com") {
        header("Location: dashboard.php");
        exit;
    }

    // --- CART HANDLING (persistent cart system) ---

    // Check if user has an existing cart
    $stmt = $mysqli->prepare("SELECT cart_id FROM carts WHERE user_id = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows === 0) {
        // No cart exists → create new one
        $stmt = $mysqli->prepare("INSERT INTO carts (user_id) VALUES (?)");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $cartId = $stmt->insert_id;
    } else {
        // Load existing cart
        $row = $res->fetch_assoc();
        $cartId = $row["cart_id"];
    }

    // Save cart id to session
    $_SESSION["cart_id"] = $cartId;

    // Redirect to shop
    header("Location: shop.php");
    exit;
}
?>
