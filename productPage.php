<?php

require_once 'config.php';
session_start();
$products = null;
try {
    $mysqli = db::getDB();
} catch (Error $e) {
    $mysqli = null;
}

// Fallback to array database if no connection just for testing, make sure to DELETE
if ($mysqli === null) {
    $products = [
            1 => new ProductClass(1, "Prism LX1", "Large Format camera...\n\nMaterial: Magnesium alloy\nSensor: Full-frame CMOS 36MP\nLens Mount: RL Mount\nApprox Dimensions: 168 x 125 x 100 mm", 5000, "Large Format"),
            2 => new ProductClass(2, "Prism LX2", "Large Format camera...\n\nMaterial: Magnesium alloy\nSensor: Medium-format CMOS 40.2MP\nLens Mount: RL Mount\nApprox Dimensions: 170 x 128 x 102 mm", 5500, "Large Format"),
            3 => new ProductClass(3, "Horizon Y1", "Y Series camera...\n\nMaterial: Polycarbonate + aluminum\nSensor: Full-frame CMOS 24.2MP\nLens Mount: RD Mount\nApprox Dimensions: 135 x 92 x 72 mm", 2000, "Y Series"),
            4 => new ProductClass(4, "Horizon Y2", "Y Series camera...\n\nMaterial: Polycarbonate + aluminum\nSensor: Full-frame CMOS 28MP\nLens Mount: RD Mount\nApprox Dimensions: 138 x 95 x 75 mm", 2200, "Y Series"),
            22 => new ProductClass(22, "Prism Cyan", "Standard camera...\n\nMaterial: Magnesium alloy\nSensor: Full-frame CMOS 26MP\nLens Mount: RD Mount\nApprox Dimensions: 150 x 110 x 87 mm", 3000, "Standard"),
            6 => new ProductClass(6, "Prism Glacier", "Standard camera...\n\nMaterial: Titanium + polycarbonate\nSensor: Full-frame CMOS 29.2MP\nLens Mount: RD Mount\nApprox Dimensions: 152 x 112 x 89 mm", 3500, "Standard"),
            7 => new ProductClass(7, "Radiant Azure", "Standard camera...\n\nMaterial: Magnesium alloy\nSensor: Full-frame CMOS 32MP\nLens Mount: RD Mount\nApprox Dimensions: 156 x 116 x 93 mm", 3800, "Standard"),
            8 => new ProductClass(8, "Amethyst Pro", "Standard camera...\n\nMaterial: Magnesium alloy\nSensor: Full-frame CMOS 34.2MP\nLens Mount: RD Mount\nApprox Dimensions: 160 x 120 x 97 mm", 4000, "Standard"),
    ];

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $productItem = $products[$id];

        if ($productItem === null) {
            echo "Product not found";
            exit();
        }
    } else {
        echo "Product not found";
        exit();
    }
} else {
    // Use database if available
    $productRepo = new ProductRepo($mysqli);
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $productItem = $productRepo->findProductByID($id);

        if ($productItem === null) {
            echo "Product not found";
            exit();
        }
    } else {
        echo "Product not found";
        exit();
    }
}
$_SESSION['productItem'] = $productItem;
//$_SESSION['re'] = 'productPage.php?id=' . $productItem->getId();
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Product Page</title>

    <!-- Bootstrap -->
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>


    <!-- Icons for Cart -->
<!--    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css'>-->

    <link rel='stylesheet' href='productPage.css'>
    <link rel="stylesheet" href="cart.css">
<!--    <script src="cart.js"></script>-->
</head>

<body>

<!-- NAVBAR -->
<nav class='navbar navbar-expand-lg bg-white position-relative'>
    <div class='container'>

        <!-- Brand left -->
        <a class='navbar-brand fw-bold' href='shop.php'>Rhad Cameras</a>

        <!-- LINKS -->
        <div class='nav-center'>
            <a class='nav-link' href='shop.php'>Shop</a>
            <a class='nav-link' href='about.php'>About</a>
        </div>

        <!-- Cart right -->
        <a href="cart.php" class="cart-icon">
            <img src="/photos/cart.png" alt="Cart" class="cart-image">
        </a>


    </div>
</nav>

<!-- PAGE CONTENT -->
<div class='container py-5'>
    <div class='row g-5 align-items-start'>

        <!-- LEFT: IMAGE -->
        <div class='col-md-6 text-center'>
            <?php echo "<img src='/photos/prod".  $productItem->getId() . ".jpg' class='product-image' alt='Camera'>"?>
        </div>

        <!-- RIGHT: DETAILS -->
        <div class='col-md-6'>
            <h2 class='fw-bold' id='name'><?php echo $productItem->getName(); ?></h2>

            <p class='price'>$<?php echo $productItem->getPrice(); ?></p>

            <label class='form-label'>MODEL:</label>
            <select class='form-select w-auto mb-3'>
                <option selected>Select Model</option>
                <option>Body Only</option>
                <option>With 20mm Lens</option>
                <option>With 50mm Lens</option>
                <option>With 105mm Lens</option>
            </select>

<!--       put logic so display this if stock for this product is 0
            <p class='text-danger fw-semibold'>Out of Stock</p>-->
            <!--      old button-->


            <form method="POST" action="add_to_cart.php">
                <input type="hidden" name="redirect_to" value="<?php echo 'productPage.php?id=' . $productItem->getId();?>">
                <button class='add-btn' type="submit">ADD TO CART</button>
            </form>

            <!-- SPECS -->
            <div class='mt-4'>
                <p class='spec-label'>Series:</p>
                <p class='series'><?php echo $productItem->getCategory(); ?></p>
                <p class='desc'><?php echo nl2br($productItem->getDesc()); ?></p>
            </div>

        </div>
    </div>
</div>

<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js'></script>

</body>
</html>
