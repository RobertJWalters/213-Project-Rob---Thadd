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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<nav id="navbar">
    <div class="nav-left">
        <div class="logo">Rhad Cameras</div>

    </div>

    <div class="nav-right">
        <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" class="nav-login">LOGIN</a>
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