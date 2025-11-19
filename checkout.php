<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rhad Cameras - Checkout</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            position: relative;
            top: 100px;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #fafafa;
            color: #333;
        }

        header {
            background: #fafafa;
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #e5e5e5;
        }

        .logo {
            font-size: 32px;
            font-weight: 600;
            font-family: 'Baskerville', 'Times New Roman', serif;
            color: #000;
            text-decoration: none;
        }

        .container {
            display: grid;
            grid-template-columns: 1fr 400px;
            max-width: 1400px;
            margin: 0 auto;
            gap: 40px;
            padding: 40px;
            min-height: calc(100vh - 100px);
        }

        .left {
            background: white;
            padding: 30px;
            border-radius: 8px;
            overflow-y: auto;
        }

        .right {
            background: white;
            padding: 30px;
            border-radius: 8px;
            height: fit-content;
            position: sticky;
            top: 100px;
        }

        h2 {
            font-size: 16px;
            font-weight: 600;
            margin: 30px 0 15px 0;
        }

        h2:first-child {
            margin-top: 0;
        }

        .button-group {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        button {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-paypal {
            background: #ffc439;
            color: #003087;
        }

        .btn-gpay {
            background: #000;
            color: white;
        }

        .btn-shop {
            background: #f0f0f0;
            color: #333;
        }

        .divider {
            text-align: center;
            color: #999;
            margin: 20px 0;
            font-size: 14px;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            margin-bottom: 12px;
            font-family: inherit;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: #333;
        }

        .row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .row input {
            margin-bottom: 0;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .checkbox-group input {
            width: 18px;
            height: 18px;
            margin: 0;
        }

        .checkbox-group label {
            margin: 0;
            font-size: 14px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .sign-in {
            font-size: 14px;
        }

        .sign-in a {
            color: #000;
            text-decoration: underline;
            cursor: pointer;
        }

        .shipping-info {
            background: #f5f5f5;
            padding: 15px;
            border-radius: 4px;
            color: #999;
            font-size: 13px;
        }

        .payment-option {
            border: 2px solid #ddd;
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 10px;
            cursor: pointer;
        }

        .payment-option.active {
            border-color: #333;
            background: #f9f9f9;
        }

        .payment-option input {
            width: auto;
            margin: 0 8px 0 0;
            padding: 0;
            vertical-align: middle;
        }

        .payment-option label {
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            margin: 0;
        }

        .pay-button {
            width: 100%;
            padding: 14px;
            background: #1a1a1a;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 20px;
        }

        .pay-button:hover {
            background: #333;
        }

        .terms {
            font-size: 12px;
            color: #999;
            margin-top: 15px;
            line-height: 1.6;
        }

        .terms a {
            color: #000;
            text-decoration: underline;
        }

        .footer-links {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #e5e5e5;
            font-size: 12px;
        }

        .footer-links a {
            color: #000;
            text-decoration: underline;
        }

        /* Order Summary Styles */
        .item {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e5e5e5;
        }

        .item-image {
            width: 70px;
            height: 70px;
            background: #f0ebe3;
            border-radius: 4px;
            flex-shrink: 0;
            position: relative;
        }

        .quantity-badge {
            position: absolute;
            top: -8px;
            left: -8px;
            width: 24px;
            height: 24px;
            background: #000;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
        }

        .item-details h4 {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .item-details p {
            font-size: 12px;
            color: #999;
        }

        .item-price {
            font-weight: 600;
            margin-top: 5px;
        }

        .discount-section {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .discount-section input {
            flex: 1;
            margin-bottom: 0;
        }

        .discount-section button {
            width: auto;
            padding: 10px 20px;
            background: #f0f0f0;
            color: #666;
            flex-shrink: 0;
            margin: 0;
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 14px;
        }

        .total-row {
            font-size: 18px;
            font-weight: 600;
            border-top: 2px solid #e5e5e5;
            padding-top: 15px;
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .shipping-link {
            color: #333;
            text-decoration: underline;
            cursor: pointer;
        }
    </style>
    <link rel="stylesheet" href="./styles.css">
</head>

<body>
<nav id="navbar">
    <div class="nav-left">
        <div class="logo">Rhad Cameras</div>

    </div>

    <div class="nav-right">
        <a href="#">ABOUT</a>
        <a hreft="#" class="cart">
            <p>Q</p> <!-- replace with icon-->
            <span class="cart-badge"></span>
        </a>
    </div>
</nav>

<div class="container">
    <!-- Left: Form -->
    <div class="left">
        <h2>Express checkout</h2>
        <div class="button-group">
            <button class="btn-shop">Shop Pay</button>
            <button class="btn-paypal">PayPal</button>
            <button class="btn-gpay">G Pay</button>
        </div>

        <div class="divider">OR</div>

        <!-- Contact Section -->
        <div>
            <div class="section-header">
                <h2 style="margin: 0;">Contact</h2>
                <div class="sign-in"><a href="#">Sign in</a></div>
            </div>
            <input type="email" placeholder="Email or mobile phone number">
            <div class="checkbox-group">
                <input type="checkbox" id="news" checked>
                <label for="news">Email me with news and offers</label>
            </div>
        </div>

        <!-- Delivery Section -->
        <h2>Delivery</h2>
        <select>
            <option>Canada</option>
        </select>
        <div class="row">
            <input type="text" placeholder="First name">
            <input type="text" placeholder="Last name">
        </div>
        <input type="text" placeholder="Company (optional)">
        <input type="text" placeholder="Address">
        <input type="text" placeholder="Apartment, suite, etc. (optional)">
        <div class="row">
            <input type="text" placeholder="City">
            <select>
                <option>Province</option>
            </select>
        </div>
        <input type="text" placeholder="ZIP code">
        <input type="tel" placeholder="Phone (optional)">
        <div class="checkbox-group">
            <input type="checkbox" id="sms">
            <label for="sms">Text me with news and offers</label>
        </div>

        <!-- Shipping Method -->
        <h2>Shipping method</h2>
        <div class="shipping-info">
            Enter your shipping address to view available shipping methods.
        </div>

        <!-- Payment Section -->
        <h2>Payment</h2>
        <p style="font-size: 12px; color: #999; margin-bottom: 12px;">All transactions are secure and encrypted.</p>

        <!-- Credit Card Option -->
        <div class="payment-option active">
            <label>
                <input type="radio" name="payment" checked>
                Credit card
            </label>
        </div>
        <input type="text" placeholder="Card number">
        <div class="row">
            <input type="text" placeholder="Expiration date (MM / YY)">
            <input type="text" placeholder="Security code">
        </div>
        <input type="text" placeholder="Name on card">
        <div class="checkbox-group">
            <input type="checkbox" id="billing" checked>
            <label for="billing">Use shipping address as billing address</label>
        </div>

        <!-- PayPal Option -->
        <div class="payment-option" style="margin-top: 15px;">
            <label>
                <input type="radio" name="payment">
                PayPal
            </label>
        </div>

        <!-- Shop Pay Option -->
        <div class="payment-option">
            <label>
                <input type="radio" name="payment">
                Shop Pay - Pay in full or in installments
            </label>
        </div>

        <!-- Remember Me -->
        <h2>Remember me</h2>
        <div class="checkbox-group">
            <input type="checkbox" id="remember" checked>
            <label for="remember">Save my information for a faster checkout</label>
        </div>
        <input type="tel" placeholder="Mobile phone number" value="+1">

        <button class="pay-button">Pay now</button>

        <div class="terms">
            Your info will be saved to a Shop account. By continuing, you agree to <a href="#">Terms of Service</a>
            and <a href="#">Privacy Policy</a>.
        </div>

        <div class="footer-links">
            <a href="#">Refund policy</a>
            <a href="#">Shipping</a>
            <a href="#">Privacy policy</a>
            <a href="#">Terms</a>
            <a href="#">Cancellations</a>
        </div>
    </div>

    <!-- Right: Order Summary (Sticky) -->
    <div class="right">
        <!-- Product Item -->
        <div class="item">
            <div class="item-image">
                <div class="quantity-badge">1</div>
            </div>
            <div class="item-details">
                <h4>A1</h4>
                <p>Yellow Camera</p>
                <p class="item-price">$99.99</p>
            </div>
        </div>

        <!-- Discount Code -->
        <div class="discount-section">
            <input type="text" placeholder="Discount code">
            <button>Apply</button>
        </div>

        <!-- Price Summary -->
        <div class="price-row">
            <span>Subtotal</span>
            <span>$99.99</span>
        </div>

        <div class="price-row">
            <span>Shipping</span>
            <span class="shipping-link">Enter shipping address</span>
        </div>

        <!-- Total -->
        <div class="total-row">
            <span>Total</span>
            <span>CAD <strong>$119.99</strong></span>
        </div>
    </div>
</div>
</body>

</html>
