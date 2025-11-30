<?php
require_once "config.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    $mysqli = db::getDB();

    $stmt = $mysqli->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows === 1) {
        $user = $res->fetch_assoc();

        if (password_verify($password, $user["password_hash"])) {

            $_SESSION["user"] = [
                "email" => $user["email"],
                "name"  => $user["name"]
            ];

            header("Location: shop.php");
            exit;
        }
    }

    $_SESSION["login_error"] = "Incorrect email or password.";
    header("Location: shop.php");
    exit;
}
