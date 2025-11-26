<?php
require_once "config.php";


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
    $data = array_values($products);
} else {
    $prodRepo = new ProductRepo($mysqli);
    $data = $prodRepo->findAll();
}
?>
<!-- Some code made with the help of AI tools-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="./styles.css">
    <link rel="stylesheet" href="./dashboard.css">
    <script src="dashboard.js"></script>
</head>

<body>

<!-- Admin Navbar -->
<nav id="navbar">
    <div class="nav-left">
        <div class="logo">Rhad Cameras</div>
    </div>

    <div class="nav-right">
        <a href="#">ABOUT</a>
        <a href="#" class="cart">
            <p>LOGOUT</p> <!-- logout function implement-->
            <span class="cart-badge"></span>
        </a>
    </div>
</nav>

<!-- Main Container -->
<div class="container">

    <!-- Statistics -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number"><?php echo count($data); ?></div>
            <div class="stat-label">Total Products</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">12</div>
            <div class="stat-label">In Stock</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">3</div>
            <div class="stat-label">Low Stock</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">1</div>
            <div class="stat-label">Out of Stock</div>
        </div>
    </div>

    <!-- Admin Controls -->
    <div class="admin-controls">
        <div class="controls-header">
            <h2>Products</h2>
<!--            <form class="add-product" method="POST" action="add_stock.php">-->
<!--                <input type="hidden" name="redirect_to" value="dashboard.php">-->
<!--            </form>-->
            <button class="add-product-btn" onclick="loadModal()">+ Add New Product</button>
        </div>

        <!-- Alert Messages -->
        <div id="alertMessage" class="alert"></div>

        <!-- Products Table -->
        <table class="products-table">
            <thead>
            <tr>
                <th>Image</th>
                <th>Product Name</th>
                <th>Product ID</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Stock Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody id="productsTableBody">
            <?php
            foreach($data as $d){
                $quantity = rand(0, 50); // Replace with actual quantity

                $status = 'in-stock';
                if ($quantity == 0) {
                    $status = 'out-of-stock';
                }

                echo "<tr data-product-id='" . $d->getId() . "'>
                            <td><img src='prod" . $d->getId() . ".jpg' alt='Product' class='product-thumb'></td>
                            <td>" . htmlspecialchars($d->getName()) . "</td>
                            <td>#" . $d->getId() . "</td>
                            <td>\$59.99</td>
                            <td>
                                <div class='quantity-controls'>
                                    <button class='qty-btn minus-btn' data-id='" . $d->getId() . "'>−</button>
                                    <input type='number' class='quantity-input' value='" . $quantity . "' data-id='" . $d->getId() . "' min='0'>
                                    <button class='qty-btn plus-btn' data-id='" . $d->getId() . "'>+</button>
                                </div>
                            </td>
                            <td><span class='status-badge status-" . $status . "'>" . ucfirst(str_replace('-', ' ', $status)) . "</span></td>
                            <td>
                                <div class='action-buttons'>
                                    <button class='delete-btn' data-id='" . $d->getId() . "'>Delete</button>
                                </div>
                            </td>
                        </tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>


</body>

</html>