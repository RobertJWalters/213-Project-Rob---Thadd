<?php
require 'Product.php';
require 'TestProdRepo.php';
include  'cart.php';
$data = TestProdRepo::init();
?>

<!DOCTYPE html>
<html lang="en">
<!-- html and jquery Code made with the help of AI tools-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rhad Cameras - Shop</title>
    <link rel="stylesheet" href="./styles.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-
hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="cart.js"></script>
</head>

<body>
<nav id="navbar">
    <div class="nav-left">
        <div class="logo">Rhad Cameras</div>

    </div>

    <div class="nav-right">
        <a href="#">ABOUT</a>
        <a hreft="#" class="cart">
            <p>Q</p> <!-- replace with icon-->
            <span class="cart-badge"></span>
        </a>
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
            <!-- Product Card Example - Duplicate this structure for each product -->
            <?php
            foreach($data as $d){
                echo "<div class='product-card'>" .
                        "<img src='prod" . $d->getId() . ".jpg' alt='Product? id' class='product-image'>
                . <h3 class='product-name'>". $d->getName() . "</h3>
                <p class='product-price'>$59.99</p>
            </div> ";
            }
            ?>

        </div>
    </div>
</section>
</body>

</html>