<?php
require_once "config.php";


$mysqli = db::getDB();


$prodRepo = new ProductRepo($mysqli);
$data = $prodRepo->findAll();

$SESSION['prodRepo'] = $prodRepo;
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
<?php include "navbar.php"; ?>


<!-- Main Container -->
<main class="container">

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
            foreach ($data as $d) {
                $quantity = $d->getStockQuantity();

                $status = 'in-stock';
                if ($quantity == 0) {
                    $status = 'out-of-stock';
                }
                $id = htmlspecialchars($d->getId());

                echo "<tr data-product-id='" . $id . "'>
                            <td><img src='/photos/prod" . $id . ".jpg' alt='Product' class='product-thumb'></td>
                            <td>" . htmlspecialchars($d->getName()) . "</td>
                            <td>ID:" . $id . "</td>
                            <td>$ " . number_format($d->getPrice(), 2, '.', ',') . " </td>
                            <td>
                                <form class='quantity-controls' method='POST' action='update_stock.php'>
                                    <input type='hidden' name='id' value='" . $id . "'>
                                    <button class='qty-btn minus-btn' name='action' value='decrease' type='submit'>−</button>
                                    <input type='number' class='quantity-input' name='quantity' value='" . htmlspecialchars($quantity) . "' min='0'>
                                    <button class='qty-btn plus-btn' name='action' value='increase' type='submit'>+</button>
                                </form>
                            </td>
                            <td><span class='status-badge status-" . $status . "'>" . ucfirst(str_replace('-', ' ', $status)) . "</span></td>
                            <td>
                                <form class='action-buttons' method='POST' action='delete_stock.php'>
                                    <input type='hidden' name='id' value='" . $id . "'>
                                    <button class='delete-btn' type='submit'>Delete</button>
                                </form>
                            </td>
                        </tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</main>


</body>

</html>