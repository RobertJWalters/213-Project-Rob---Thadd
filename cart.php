<?php

require_once "config.php";
session_start();
//try {
//    $mysqli = db::getDB();
//} catch (Error $e) {
//    $mysqli = null;
//}

// Fallback to array database if no connection
//if ($mysqli === null) {

if (!isset($_SESSION['cart'])) {
    $d = null;
} else {
    $cart = $_SESSION['cart'];
    try{
    $d = $cart->getProduct();
    }catch(Error $e){
        echo "fail";
    }

}
//}

?>

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

            // Display cart items
            if (!isset($d)) {
                echo '<div class="empty-cart">
                        <p>Your cart is empty</p>
                    </div>';
            } else {

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

            <a href="checkOut.php">
                <button class="checkout-btn">CHECKOUT</button>
            </a>

        </div>
    </div>
</div>

</body>
</html>