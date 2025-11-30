<?php
require_once "config.php";
require_once "CartClass.php";
require_once "ProductClass.php";
require_once "ProductRepo.php";

session_start();

define("TAX_RATE", 0.25);

// Load cart
if (!isset($_SESSION['cart'])) {
    $cartData = [];
} else {
    $cart = $_SESSION['cart'];
    $cartData = $cart->getProducts();
}

// Totals
$subTotal = 0;
foreach ($cartData as $item) {
    $subTotal += $item['product']->getPrice() * $item['quantity'];
}
$tax = $subTotal * TAX_RATE;
$total = $subTotal + $tax;

$formattedSubTotal = number_format($subTotal, 2, '.', ',');
$formattedTax = number_format($tax, 2, '.', ',');
$formattedTotal = number_format($total, 2, '.', ',');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rhad Cameras - Checkout</title>

    <link rel="stylesheet" href="styles.css">

    <style>
        /* --- same CSS you already had --- */
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            position: relative;
            top: 120px;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #fafafa;
            color: #333;
        }

        .container {
            display: grid;
            grid-template-columns: 1fr 400px;
            max-width: 1400px;
            margin: 0 auto;
            gap: 40px;
            padding: 40px;
        }

        .left, .right {
            background: white;
            padding: 30px;
            border-radius: 8px;
        }

        .right { position: sticky; top: 140px; height: fit-content; }

        h2 { font-size: 18px; font-weight: 600; margin: 25px 0 15px; }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .row-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .button-group button {
            padding: 12px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            flex: 1;
        }

        .btn-shop { background: #f0f0f0; }
        .btn-paypal { background: #ffc439; color: #003087; }
        .btn-gpay { background: #000; color: white; }

        .divider { text-align: center; color: #999; margin: 20px 0; }

        .pay-button {
            width: 100%;
            padding: 14px;
            background: #000;
            color: white;
            border-radius: 4px;
            margin-top: 20px;
            font-size: 16px;
            cursor: pointer;
        }

        /* Order Summary */
        .item { display: flex; gap: 15px; margin-bottom: 20px; padding-bottom: 20px;
            border-bottom: 1px solid #e5e5e5; }

        .item-image {
            width: 70px; height: 70px; border-radius: 4px;
            background: #f0ebe3; position: relative; overflow: hidden;
        }

        .item-image img { width: 100%; height: 100%; object-fit: cover; }

        .quantity-badge {
            position: absolute; top: -8px; left: -8px;
            width: 24px; height: 24px; background: #000; color: #fff;
            font-size: 12px; display: flex; align-items: center; justify-content: center;
            border-radius: 50%; font-weight: bold;
        }

        .price-row, .total-row {
            display: flex; justify-content: space-between;
            margin: 12px 0;
        }

        .total-row { font-size: 18px; font-weight: bold; padding-top: 15px; border-top: 2px solid #e5e5e5; }
    </style>
</head>

<body>

<?php include 'navbar.php'; ?>

<div class="container">

    <!-- LEFT SIDE -->
    <div class="left">

        <h2>Express checkout</h2>

        <div class="button-group" style="display:flex; gap:10px;">
            <button class="btn-shop">Shop Pay</button>
            <button class="btn-paypal">PayPal</button>
            <button class="btn-gpay">G Pay</button>
        </div>

        <div class="divider">OR</div>

        <!-- FULL FORM -->
        <form method="POST" action="processOrder.php">

            <!-- CONTACT -->
            <h2>Contact Information</h2>
            <input type="email" name="email" placeholder="Email" required>

            <!-- DELIVERY -->
            <h2>Delivery Details</h2>

            <div class="row-2">
                <input type="text" name="first_name" placeholder="First name" required>
                <input type="text" name="last_name" placeholder="Last name" required>
            </div>

            <input type="text" name="address" placeholder="Street address" required>
            <input type="text" name="apartment" placeholder="Apartment, suite, etc. (optional)">

            <div class="row-2">
                <input type="text" name="city" placeholder="City" required>
                <select name="province" required>
                    <option value="" disabled selected>Province</option>
                    <option>BC</option><option>AB</option><option>SK</option>
                    <option>MB</option><option>ON</option><option>QC</option>
                    <option>NB</option><option>NS</option><option>PE</option>
                    <option>NL</option>
                </select>
            </div>

            <input type="text" name="postal" placeholder="Postal Code" required>
            <input type="tel" name="phone" placeholder="Phone number">

            <!-- PAYMENT -->
            <h2>Payment Details</h2>

            <input type="text" name="card_name" placeholder="Name on card" required>
            <input type="text" name="card_number" placeholder="Card number" maxlength="19" required>

            <div class="row-2">
                <input type="text" name="expiry" placeholder="MM / YY" maxlength="5" required>
                <input type="text" name="cvv" placeholder="CVV" maxlength="4" required>
            </div>

            <h2>Billing Address</h2>
            <label>
                <input type="checkbox" name="billing_same" checked>
                Same as shipping address
            </label>

            <button class="pay-button" type="submit">Pay now</button>

        </form>
    </div>


    <!-- RIGHT SIDE (Order Summary) -->
    <div class="right">

        <?php if (empty($cartData)): ?>
            <h3>Your cart is empty</h3>

        <?php else: ?>

            <?php foreach ($cartData as $id => $item):
                $p = $item['product'];
                $qty = $item['quantity'];
                $price = number_format($p->getPrice(), 2, '.', ',');
                ?>

                <div class="item">
                    <div class="item-image">
                        <div class="quantity-badge"><?= $qty ?></div>
                        <img src="photos/prod<?= $p->getId() ?>.jpg">
                    </div>

                    <div class="item-details">
                        <h4><?= htmlspecialchars($p->getName()) ?></h4>
                        <?php if ($p->getCategory() !== "none") : ?>
                            <p><?= htmlspecialchars($p->getCategory()) ?></p>
                        <?php endif; ?>
                        <p class="item-price">$<?= $price ?></p>
                    </div>
                </div>

            <?php endforeach; ?>

            <div class="price-row">
                <span>Subtotal</span>
                <span>$<?= $formattedSubTotal ?></span>
            </div>

            <div class="price-row">
                <span>Shipping</span>
                <span>Always Free!</span>
            </div>

            <div class="price-row">
                <span>Tax</span>
                <span>$<?= $formattedTax ?></span>
            </div>

            <div class="total-row">
                <span>Total</span>
                <span>CAD <strong>$<?= $formattedTotal ?></strong></span>
            </div>

        <?php endif; ?>

    </div>
</div>

</body>
</html>
