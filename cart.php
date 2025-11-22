<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-
hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="cart.js"></script>
    <link rel="stylesheet" href="cart.css">

    <title>Shopping Cart</title>

</head>
<body>
<nav id="navbar">
    <div class="nav-left">
        <a class='logo' href='shop.php'>Rhad Cameras</a>
    </div>
    <div class="nav-right">
        <a class='nav-link' href='shop.php'>Continue Shopping</a>
    </div>
</nav>

<div class="page-container">

    <h1 class="page-title">Shopping Cart</h1>

    <div class="cart-container">
        <!-- Main Cart Items -->
        <div class="cart-items">
            <?php
            // Your PHP code here
            require_once "config.php";

            try {
                $mysqli = db::getDB();
            } catch (Error $e) {
                $mysqli = null;
            }

            // Fallback to array database if no connection
            if ($mysqli === null) {
                $products = [
                        1 => new ProductClass(1, "Prism LX1", "Large Format camera...\n\nMaterial: Magnesium alloy\nSensor: Full-frame CMOS 36MP\nLens Mount: RL Mount\nApprox Dimensions: 168 x 125 x 100 mm", 5000, "Large Format"),
                        2 => new ProductClass(2, "Prism LX2", "Large Format camera...\n\nMaterial: Magnesium alloy\nSensor: Medium-format CMOS 40.2MP\nLens Mount: RL Mount\nApprox Dimensions: 170 x 128 x 102 mm", 5500, "Large Format"),
//                        3 => new ProductClass(3, "Horizon Y1", "Y Series camera...\n\nMaterial: Polycarbonate + aluminum\nSensor: Full-frame CMOS 24.2MP\nLens Mount: RD Mount\nApprox Dimensions: 135 x 92 x 72 mm", 2000, "Y Series"),
//                        4 => new ProductClass(4, "Horizon Y2", "Y Series camera...\n\nMaterial: Polycarbonate + aluminum\nSensor: Full-frame CMOS 28MP\nLens Mount: RD Mount\nApprox Dimensions: 138 x 95 x 75 mm", 2200, "Y Series"),
//                        5 => new ProductClass(5, "Prism Cyan", "Standard camera...\n\nMaterial: Magnesium alloy\nSensor: Full-frame CMOS 26MP\nLens Mount: RD Mount\nApprox Dimensions: 150 x 110 x 87 mm", 3000, "Standard"),
//                        6 => new ProductClass(6, "Prism Glacier", "Standard camera...\n\nMaterial: Titanium + polycarbonate\nSensor: Full-frame CMOS 29.2MP\nLens Mount: RD Mount\nApprox Dimensions: 152 x 112 x 89 mm", 3500, "Standard"),
//                        7 => new ProductClass(7, "Radiant Azure", "Standard camera...\n\nMaterial: Magnesium alloy\nSensor: Full-frame CMOS 32MP\nLens Mount: RD Mount\nApprox Dimensions: 156 x 116 x 93 mm", 3800, "Standard"),
//                        8 => new ProductClass(8, "Amethyst Pro", "Standard camera...\n\nMaterial: Magnesium alloy\nSensor: Full-frame CMOS 34.2MP\nLens Mount: RD Mount\nApprox Dimensions: 160 x 120 x 97 mm", 4000, "Standard"),
                ];
                $data = array_values($products);
            } else {
                $prodRepo = new ProductRepo($mysqli);
                $data = $prodRepo->findAll();
            }

            // Display cart items
            if (empty($data)) {
                echo '<div class="empty-cart">
                        <p>Your cart is empty</p>
                    </div>';
            } else {
                foreach ($data as $d) {
                    $id = $d->getId();
                    $name = $d->getName();
                    $formattedPrice = number_format($d->getPrice() / 1, 2, '.', ',');

                    echo '<div class="cart-item">
                            <img src="/photos/prod' . $id . '.jpg" alt="' . htmlspecialchars($name) . '" class="item-image">
                            <div class="item-details">
                                <h3>' . htmlspecialchars($name) . '</h3>
                                <p>Product ID: ' . $id . '</p>
                                <div class="item-controls">
                                    <div class="quantity-control">
                                        <button type="button" class="decrease-qty">−</button>
                                        <input type="number" value="1" min="1" class="qty-input">
                                        <button type="button" class="increase-qty">+</button>
                                    </div>
                                    <button class="remove-btn" title="Remove">✕</button>
                                </div>
                            </div>
                            <div class="item-price">
                                <div class="price">$' . $formattedPrice . ' </div>
                            </div>
                        </div>';
                }
            }
            ?>
        </div>

        <!-- Sidebar Summary -->
        <div class="cart-sidebar">
            <div class="sidebar-header">
                <h2>Order Summary</h2>
                <a href="shop.php" class="close-btn">CONTINUE SHOPPING</a>
            </div>

            <div class="summary">
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span id="subtotal">$0.00</span>
                </div>
                <div class="summary-row">
                    <span>Shipping</span>
                    <span id="shipping">Calculated</span>
                </div>
                <div class="summary-row">
                    <span>Tax</span>
                    <span id="tax">$0.00</span>
                </div>
                <div class="summary-row total">
                    <span>Total</span>
                    <span id="total">$0.00</span>
                </div>
            </div>

            <button class="checkout-btn">CHECKOUT</button>
        </div>
    </div>
</div>

</body>
</html>