<?php
require_once "config.php";
try {
    $mysqli = db::getDB();
} catch (Error $e) {
    $mysqli = null;
}

// Fallback to array database if no connection for testing. Must DELETE
if ($mysqli === null) {
    $products = [
            1 => new ProductClass(1, "Prism LX1", "Large Format camera...\n\nMaterial: Magnesium alloy\nSensor: Full-frame CMOS 36MP\nLens Mount: RL Mount\nApprox Dimensions: 168 x 125 x 100 mm", 5000, "Large Format"),
            2 => new ProductClass(2, "Prism LX2", "Large Format camera...\n\nMaterial: Magnesium alloy\nSensor: Medium-format CMOS 40.2MP\nLens Mount: RL Mount\nApprox Dimensions: 170 x 128 x 102 mm", 5500, "Large Format"),
            3 => new ProductClass(3, "Horizon Y1", "Y Series camera...\n\nMaterial: Polycarbonate + aluminum\nSensor: Full-frame CMOS 24.2MP\nLens Mount: RD Mount\nApprox Dimensions: 135 x 92 x 72 mm", 2000, "Y Series"),
            4 => new ProductClass(4, "Horizon Y2", "Y Series camera...\n\nMaterial: Polycarbonate + aluminum\nSensor: Full-frame CMOS 28MP\nLens Mount: RD Mount\nApprox Dimensions: 138 x 95 x 75 mm", 2200, "Y Series"),
            5 => new ProductClass(5, "Prism Cyan", "Standard camera...\n\nMaterial: Magnesium alloy\nSensor: Full-frame CMOS 26MP\nLens Mount: RD Mount\nApprox Dimensions: 150 x 110 x 87 mm", 3000, "Standard"),
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
<!-- html css Code made with the help of AI tools-->
<div id="cart-overlay"></div>

<!-- Cart Sidebar -->
<div class="cart-sidebar">
    <div class="cart-header">
        <h2>Your basket</h2>
        <button class="close-btn">&times;</button>
    </div>


    <div class="cart-products">
        <!-- Product Card Example - Duplicate this structure for each product -->
        <?php

        foreach ($data as $d) {
            $id = $d->getId();
            echo "<div class='cart-product'>" .
                    "<a href='productPage.php?id=" . $id . "'></a>
                  . <h3 class='product-name'>" . $d->getName() . "</h3>
                      <p class='product-price'>$59.99</p>
                        <div class='item-quantity'>
                            <input type='number' value='1' min='1' class='qty-input'>
                            <button class='remove-btn'>Remove</button>
                        </div>
            </div> ";
        }
        ?>
    </div>
</div>

