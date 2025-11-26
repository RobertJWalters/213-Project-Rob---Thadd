<?php

require_once "config.php";
session_start();


try {
    $mysqli = db::getDB();
} catch (Error $e) {
    $mysqli = null;
}

// Fallback to array database if no connection just for testing, make sure to DELETE
if ($mysqli === null) {
    $products = [
            1 => new ProductClass(1, "Prism LX1", "Large Format camera...\n\nMaterial: Magnesium alloy\nSensor: Full-frame CMOS 36MP\nLens Mount: RL Mount\nApprox Dimensions: 168 x 125 x 100 mm", 5000, "Large Format", 0),
            2 => new ProductClass(2, "Prism LX2", "Large Format camera...\n\nMaterial: Magnesium alloy\nSensor: Medium-format CMOS 40.2MP\nLens Mount: RL Mount\nApprox Dimensions: 170 x 128 x 102 mm", 5500, "Large Format", 3),
            3 => new ProductClass(3, "Horizon Y1", "Y Series camera...\n\nMaterial: Polycarbonate + aluminum\nSensor: Full-frame CMOS 24.2MP\nLens Mount: RD Mount\nApprox Dimensions: 135 x 92 x 72 mm", 2000, "Y Series", 6),
            4 => new ProductClass(4, "Horizon Y2", "Y Series camera...\n\nMaterial: Polycarbonate + aluminum\nSensor: Full-frame CMOS 28MP\nLens Mount: RD Mount\nApprox Dimensions: 138 x 95 x 75 mm", 2200, "Y Series", 5),
            22 => new ProductClass(22, "Prism Cyan", "Standard camera...\n\nMaterial: Magnesium alloy\nSensor: Full-frame CMOS 26MP\nLens Mount: RD Mount\nApprox Dimensions: 150 x 110 x 87 mm", 3000, "Standard", 7),
            6 => new ProductClass(6, "Prism Glacier", "Standard camera...\n\nMaterial: Titanium + polycarbonate\nSensor: Full-frame CMOS 29.2MP\nLens Mount: RD Mount\nApprox Dimensions: 152 x 112 x 89 mm", 3500, "Standard", 156),
            7 => new ProductClass(7, "Radiant Azure", "Standard camera...\n\nMaterial: Magnesium alloy\nSensor: Full-frame CMOS 32MP\nLens Mount: RD Mount\nApprox Dimensions: 156 x 116 x 93 mm", 3800, "Standard", 3),
            8 => new ProductClass(8, "Amethyst Pro", "Standard camera...\n\nMaterial: Magnesium alloy\nSensor: Full-frame CMOS 34.2MP\nLens Mount: RD Mount\nApprox Dimensions: 160 x 120 x 97 mm", 4000, "Standard", 56),
    ];
    $data = array_values($products);
} else {
    $prodRepo = new ProductRepo($mysqli);
    $data = $prodRepo->findAll();
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = new CartClass(null);
}

?>

<!DOCTYPE html>
<html lang="en">
<!-- html and jquery Code made with the help of AI tools-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rhad Cameras - Shop</title>
    <link rel="stylesheet" href="./styles.css">
    <link rel="stylesheet" href="cart.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-
hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="cart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!--    <script src="cart.js"></script>-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<nav id="navbar">
    <div class="nav-left">
        <div class="logo">Rhad Cameras</div>

    </div>

    <div class="nav-right">
        <a href="#">ABOUT</a>
        <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" class="nav-login">LOGIN</a>
        <div class="cart">
            <a href="cart.php" class="cart-icon">
                <img src="/photos/cart.png" alt="Cart" class="cart-image">
            </a>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <h1 class="hero-title">SHOP</h1>
    </div>
</section>

<!-- Filter Section -->
<section class="filter-section">
    <div class="container">
        <div class="filter-buttons">
            <button class="filter-btn active">All</button>
            <button class="filter-btn">Y Series</button>
            <button class="filter-btn">Large Format</button>
        </div>
    </div>
</section>

<!-- Products Section -->
<section class="products">
    <div class="container">
        <div class="product-grid">
            <!-- Dynamically load products -->
            <?php
//            $data = $prodRepo->findAll();
            foreach ($data as $d) {
                $id = $d->getId();
                echo "<div class='product-card'>
                <a href='productPage.php?id=" . $id . "'>" .
                        "<img src='/photos/prod" . $id . ".jpg' alt='Product? id' class='product-image'>
                . <h3 class='product-name'>" . $d->getName() . "</h3>
                <p class='product-price'>$" . $d->getPrice() . "</p>
                </a>
            </div> ";
            }
            ?>

        </div>
    </div>
</section>
<!-- LOGIN MODAL -->
<div class="modal fade" id="loginModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px; padding: 10px;">

            <div class="modal-header border-0">
                <h5 class="modal-title">Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form action="dashboard.php" method="POST">

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="you@example.com" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                    </div>

                    <button type="submit" class="btn w-100"
                            style="background:#76eec6; font-weight:bold;">
                        Login
                    </button>

                </form>
            </div>

            <div class="modal-footer border-0">
                <a href="#" class="small">Forgot Password?</a>
            </div>

        </div>
    </div>
</div>

</body>

</html>
