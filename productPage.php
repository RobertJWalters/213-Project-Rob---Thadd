<?php
// AI tools were used during development to assist developers
// Robert Walters and Thadd McLeod
require_once 'config.php';
session_start();
$products = null;
// Load database
$mysqli = db::getDB();

// Initialize ProductRepo with database connection
$productRepo = new ProductRepo($mysqli);
if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8');
    $productItem = $productRepo->findProductByID($id);

    if ($productItem === null) {
        echo "Product not found";
        exit();
    }
} else {
    echo "Product not found";
    exit();
}

$_SESSION['productItem'] = $productItem;
$qty = $productItem->getStockQuantity();
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Product Page</title>

    <!-- Bootstrap -->
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    -->


    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css'>

    <link rel='stylesheet' href='productPage.css'>
    <link rel="stylesheet" href="cart.css">
</head>

<body>

<?php include 'navbar.php'; ?>


<!-- PAGE CONTENT -->
<main class='container py-5'>
    <div class='row g-5 align-items-start'>

        <!-- LEFT: IMAGE -->
        <div class='col-md-6 text-center'>
            <?php echo "<img src='/photos/prod" . htmlspecialchars($productItem->getId()) . ".jpg' class='product-image' alt='Camera'>" ?>
        </div>

        <!-- RIGHT: DETAILS -->
        <div class='col-md-6'>
            <h2 class='fw-bold' id='name'><?php echo htmlspecialchars($productItem->getName()); ?></h2>

            <p class='price'>$<?php echo number_format($productItem->getPrice(), 2, '.', ','); ?></p>

            <label class='form-label'>MODEL:</label>
            <label>
                <select class='form-select w-auto mb-3'>
                    <option>Body Only</option>
                    <option>With 20mm Lens</option>
                    <option>With 50mm Lens</option>
                    <option>With 105mm Lens</option>
                </select>
            </label>

            <p class='fw-semibold'><?php
                echo $qty > 0 ? $qty . " in Stock" : "<span class='text-danger'>Out of Stock</span>" ?></p>

            <?php echo $qty > 0 ? "<form method='POST' action='add_to_cart.php'>
                <input type='hidden' name='redirect_to' value='" . 'productPage.php?id=' . htmlspecialchars($productItem->getId()) . "'>
                <button class='add-btn' type='submit'>ADD TO CART</button>
            </form>" : "<button class='add-btn disabled' >ADD TO CART</button>" ?>

            <!-- SPECS -->
            <div class='mt-4'>
                <p class='spec-label'>Series:</p>
                <p class='series'><?php echo htmlspecialchars($productItem->getCategory()); ?></p>
                <p class='desc'><?php echo nl2br(htmlspecialchars($productItem->getDesc())); ?></p>
            </div>

        </div>
    </div>
</main>


<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js'></script>

</body>
</html>
