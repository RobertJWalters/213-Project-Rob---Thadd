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
    $data = null;
} else {
    $cart = $_SESSION['cart'];
    try{
    $data = $cart->getProducts();
//    echo "<br><br><br><br><br><br><br>" . var_dump($data);  //for testing
    }catch(Error $e){
        echo "fail";
    }

}
$subTotal = 0;

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
            if (!isset($data)) {
                echo '<div class="empty-cart">
                        <p>Your cart is empty</p>
                    </div>';
            } else {
                foreach ($data as $productId => $product) {
                        $subTotal += $product['product']->getPrice() * $product['quantity'];
                        $id = $product['product']->getId();
                        $name = $product['product']->getName();
                        $formattedPrice = number_format($product['product']->getPrice(), 2, '.', ',');
                        $stockQty = $product['product']->getStockQuantity();

                        echo '<div class="cart-item">
                            <img src="/photos/prod' . $id . '.jpg" alt="' . htmlspecialchars($name) . '" class="item-image">
                            <div class="item-details">
                                <h3>' . htmlspecialchars($name) . '</h3>
                                <p>' . $product['product']->getCategory() . '</p>
                                <form class="item-controls" method="POST" action="update_cart.php">
                                       <input type="hidden" name="redirect_to" value="cart.php">
                                       <input type="hidden" name="id" value="' . $id . '">
                                       <div class="quantity-control">
                                           <button class="decrease-qty" name="action" value="decrease" type="submit">−</button>
                                           <input type="hidden" name="stock-qty" value="' . $stockQty . '">
                                            <input type="number" name="qty" value="' . $product['quantity'] . '" min="1" max="' . $stockQty . '" class="qty-input">
                                            <button class="increase-qty" name="action" value="increase" type="submit">+</button>
                                        </div>
                                        <button class="remove" name="action" value="remove" type="submit">✕</button>
                              </form>
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
                    <span id="subtotal">$<?php echo $subTotal?></span>
                </div>
                <div class="summary-row">
                    <span>Shipping</span>
                    <span id="shipping">Always Free!</span>
                </div>
                <div class="summary-row">
                    <span>Tax</span>
                    <span id="tax">$<?php $tax = $subTotal * 0.25; echo $tax?></span>
                </div>
                <div class="summary-row total">
                    <span>Total</span>
                    <span id="total">$<?php echo $subTotal + $tax?></span>
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