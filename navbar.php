<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<nav id="navbar">
    <div class="nav-left">
        <a href="shop.php" class="logo">Rhad Cameras</a>
    </div>

    <div class="nav-right">
        <a href="about.php">ABOUT</a>

        <?php if (isset($_SESSION['user'])): ?>
            <span class="fw-bold">
                Hello, <?= htmlspecialchars($_SESSION['user']['name']) ?>
            </span>
            <a href="logout.php" class="nav-login" style="margin-left: 10px;">LOGOUT</a>
        <?php else: ?>
            <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" class="nav-login">LOGIN</a>
        <?php endif; ?>

        <div class="cart">
            <a href="cart.php" class="cart-icon">
                <img src="/photos/cart.png" alt="Cart" class="cart-image">
            </a>
        </div>
    </div>
</nav>
