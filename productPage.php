<?php
require_once 'config.php';
$mysqli = db::getDB();
$productItem = new ProductRepo($mysqli);

// Get id from URL query parameter
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $productItem->findProductByID($id);
} else {
    echo "Product not found";
    exit();
}
//for no db testing
//$id = 4;
//$productItem = new ProductClass(12, "Prism LX4","\nBalancing resolution with performance, the Prism LX4 provides a refined large format solution for professional cinematographers. Its robust construction and intuitive interface make it perfect for fast-paced production environments.\n\n<b>Material:</b> Magnesium alloy + polycarbonate construction\nSensor: Full-frame CMOS 42MP\nLens Mount: RL Mount\nApprox Dimensions: 165 x 122 x 98 mm", 5666.88, "Large Format");

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
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css'>
    <link rel='stylesheet' href='productpage.css'>
</head>

<body>

<!-- NAVBAR -->
<nav class='navbar navbar-expand-lg bg-white position-relative'>
    <div class='container'>

        <!-- Brand left -->
        <a class='navbar-brand fw-bold' href='index.html'>Rhad Cameras</a>

        <!-- LINKS -->
        <div class='nav-center'>
            <a class='nav-link' href='shop.php'>Home</a>
            <a class='nav-link' href='product.php'>Products</a>
        </div>

        <!-- Cart right -->
        <a href='cart.html' class='cart-icon ms-auto'>
            <i class='bi bi-cart2'></i>
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

            <p class='text-danger fw-semibold'>Out of Stock</p>

            <button class='add-btn'>ADD TO CART</button>

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
