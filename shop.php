<?php
require_once "config.php";
require_once "ProductClass.php";
require_once "ProductRepo.php";
require_once "CartClass.php";

session_start();

//MySQL database connection
$mysqli = db::getDB();

// Fetch products from DB
$query = "SELECT product_id, name, price, category FROM products";
$result = $mysqli->query($query);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Setup cart if missing
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = new CartClass(null);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rhad Cameras - Shop</title>

    <link rel="stylesheet" href="./styles.css">
    <link rel="stylesheet" href="cart.css">

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>

    <script src="cart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<?php include 'navbar.php'; ?>

<!-- Hero -->
<section class="hero">
    <div class="hero-content">
        <h1 class="hero-title">SHOP</h1>
    </div>
</section>

<!-- Filters -->
<section class="filter-section">
    <div class="container">
        <div class="filter-buttons">
            <button class="filter-btn active">All</button>
            <button class="filter-btn">Y Series</button>
            <button class="filter-btn">Large Format</button>
        </div>
    </div>
</section>

<!-- Products -->
<section class="products">
    <div class="container">
        <div class="product-grid">

            <?php
            // Loop through DB products
            foreach ($data as $d) {
                $id = $d['product_id'];

                echo "
                <div class='product-card'>
                    <a href='productPage.php?id=$id'>
                        <img src='/photos/prod$id.jpg' alt='Product $id' class='product-image'>
                        <h3 class='product-name'>{$d['name']}</h3>
                        <p class='product-price'>\$ {$d['price']}</p>
                    </a>
                </div>
                ";
            }
            ?>

        </div>
    </div>
</section>

<?php include 'loginModal.php'; ?>

</body>
</html>
