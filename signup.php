<?php
session_start();

$errors = [];
$success = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name     = htmlspecialchars(trim($_POST["name"]));
    $email    = htmlspecialchars(trim($_POST["email"]));
    $password = $_POST["password"];
    $confirm  = $_POST["confirm"];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email.";
    }

    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters.";
    }

    if ($password !== $confirm) {
        $errors[] = "Passwords do not match.";
    }

    // Load users
    $users = json_decode(file_get_contents("users.json"), true);

    // Check if email exists
    foreach ($users as $u) {
        if ($u["email"] === $email) {
            $errors[] = "Email already exists.";
        }
    }

    // Add new user
    if (empty($errors)) {
        $users[] = [
                "email"    => $email,
                "name"     => $name,
                "password" => password_hash($password, PASSWORD_DEFAULT)
        ];

        file_put_contents("users.json", json_encode($users, JSON_PRETTY_PRINT));
        $success = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Sign Up</title></head>
<body>

<h2>Sign Up</h2>

<?php if ($success): ?>
    <p style="color:green">Account created! <a href="shop.php">Log in</a></p>
<?php endif; ?>

<?php foreach ($errors as $e): ?>
    <p style="color:red"><?= htmlspecialchars($e) ?></p>
<?php endforeach; ?>

<form method="POST">
    <input type="text" name="name" placeholder="Full Name" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <input type="password" name="confirm" placeholder="Confirm Password" required><br>
    <button type="submit">Sign Up</button>
</form>

</body>
</html>
