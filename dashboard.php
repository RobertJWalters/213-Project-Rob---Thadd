<?php
require_once "config.php";


try {
    $mysqli = db::getDB();
} catch (Error $e) {
    $mysqli = null;
}

// Fallback to array database if no connection just for testing, make sure to DELETE
if ($mysqli === null) {
    echo "error";
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