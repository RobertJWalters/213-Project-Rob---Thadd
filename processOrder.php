<?php
session_start();

// Clear the cart
unset($_SESSION['cart']);

// Redirect back to the shop
header("Location: shop.php");
exit;
