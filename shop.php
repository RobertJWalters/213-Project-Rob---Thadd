<?php

require_once "config.php";
session_start();


try {
    $mysqli = db::getDB();
} catch (Error $e) {
    $mysqli = null;
}
$category = $_GET['category'];

// Fallback to array database if no connection just for testing, make sure to DELETE
if ($mysqli === null) {
    echo "error";
} else {
    $prodRepo = new ProductRepo($mysqli);
    if($category == "all"){
        $data = $prodRepo->findAll();
    }else{
        $data = $prodRepo->findByCategory($category);
    }

    $_SESSION['productRepo'] = $prodRepo;
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
        <form class="filter-buttons" method="GET" action="shop.php">
            <button class="filter-btn active" name="action" value="all" type="submit">All</button>
            <button class="filter-btn" name="action" value="Y Series" type="submit">Y Series</button>
            <button class="filter-btn" name="action" value="Large Format" type="submit">Large Format</button>
        </form>
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
