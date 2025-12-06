<?php
// AI tools were used during development to assist developers
// Thadd McLeod
require_once "config.php";
session_start();

$errors = [];
$success = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name     = trim($_POST["name"]);
    $email    = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm  = $_POST["confirm"];
//    Connect database
    $mysqli = db::getDB();

    // VALIDATION
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email.";
    }

    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters.";
    }

    if ($password !== $confirm) {
        $errors[] = "Passwords do not match.";
    }

    // CHECK IF EMAIL EXISTS
    $check = $mysqli->prepare("SELECT email FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $errors[] = "Email already exists.";
    }

    // IF NO ERRORS → INSERT INTO DB
    if (empty($errors)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $insert = $mysqli->prepare(
                "INSERT INTO users (email, name, password_hash) VALUES (?, ?, ?)"
        );
        $insert->bind_param("sss", $email, $name, $hash);
        $insert->execute();

        $success = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f5f5;
            padding-top: 80px;
            font-family: Inter, sans-serif;
        }

        .back-link {
            position: absolute;
            top: 20px;
            left: 30px;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            color: black;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<!-- HOME PAGE LINK -->
<a href="shop.php" class="back-link">← Back to Home</a>

<div class="container" style="max-width: 500px;">
    <div class="card shadow-sm p-4">

        <h2 class="text-center mb-4">Create Account</h2>

        <?php if ($success): ?>
            <div class="alert alert-success">
                Account created successfully!
                <a href="shop.php" class="alert-link">Click here to log in</a>.
            </div>
        <?php endif; ?>

        <?php foreach ($errors as $e): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($e) ?></div>
        <?php endforeach; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password (min 6 characters)</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-4">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="confirm" class="form-control" required>
            </div>

            <button class="btn btn-dark w-100">Create Account</button>
        </form>
    </div>
</div>

</body>
</html>
