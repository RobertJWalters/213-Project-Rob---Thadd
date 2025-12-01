<?php
include 'loginModal.php';
require_once "config.php";
session_start();


$mysqli = db::getDB();

$category = htmlspecialchars($_GET['category'] ?? "", ENT_QUOTES, 'UTF-8');


$prodRepo = new ProductRepo($mysqli);
if ($category == "all" || $category == null) {
    $data = $prodRepo->findAll();
} else {
    $data = $prodRepo->findByCategory($category);
}
$_SESSION['productRepo'] = $prodRepo;


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
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-
hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<?php include 'navbar.php'; ?>


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
            <button class="filter-btn <?php if ($category !== "Y Series" && $category !== "Large Format")
                echo "active"; ?>" name="category" value="all" type="submit">All</button>
            <button class="filter-btn <?php if($category === "Y Series")
                echo "active";?>" name="category" value="Y Series" type="submit">Y Series</button>
            <button class="filter-btn <?php if($category === "Large Format")
                echo "active";?>" name="category" value="Large Format" type="submit">Large Format</button>
        </form>
    </div>
</section>

<!-- Products Section -->
<section class="products">
    <div class="container">
        <div class="product-grid">
            <!-- Dynamically load products -->
            <?php
            foreach ($data as $d) {
                $id = htmlspecialchars($d->getId());
                echo "<div class='product-card'>
                <a href='productPage.php?id=" . $id . "'>" .
                        "<img src='/photos/prod" . $id . ".jpg' alt='Product Image' class='product-image'>
                . <h3 class='product-name'>" . htmlspecialchars($d->getName()) . "</h3>
                <p class='product-price'>$" . number_format($d->getPrice(), 2, '.', ',') . "</p>
                </a>
            </div> ";
            }
            ?>

        </div>
    </div>
</section>


</body>

</html>
