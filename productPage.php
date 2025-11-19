<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Page</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Icons for Cart -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <style>
    body {
      background: #fff;
      font-family: 'Inter', sans-serif;
    }

    /* NAVBAR STYLE */
    .navbar {
      border-bottom: 1px solid #eee;
      padding: 15px 0;
    }
    .nav-center {
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
      display: flex;
      gap: 30px;
    }
    .nav-link {
      color: #333 !important;
      font-weight: 500;
      font-size: 17px;
    }
    .nav-link:hover {
      color: #555 !important;
    }
    .cart-icon {
      font-size: 1.4rem;
      color: #333;
    }
    .cart-icon:hover {
      color: #555;
    }

    /* PRODUCT PAGE */
    .product-image {
      width: 100%;
      border-radius: 10px;
    }
    .price {
      font-size: 1.6rem;
      font-weight: 600;
      margin-bottom: 10px;
    }
    .spec-label {
      font-weight: 600;
      margin-top: 20px;
    }
    .add-btn {
      background-color: #76eec6;
      color: #000;
      font-weight: 600;
      border: none;
      padding: 12px 20px;
      border-radius: 6px;
      transition: 0.2s;
    }
    .add-btn:hover {
      background-color: #5ed3ae;
    }
  </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg bg-white position-relative">
  <div class="container">

    <!-- Brand left -->
    <a class="navbar-brand fw-bold" href="index.html">Rhad Cameras</a>

    <!-- LINKS -->
      <div class="nav-center">
        <a class="nav-link" href="shop.php">Home</a>
        <a class="nav-link" href="product.php">Products</a>
      </div>
      
    <!-- Cart right -->
    <a href="cart.html" class="cart-icon ms-auto">
      <i class="bi bi-cart2"></i>
    </a>

  </div>
</nav>

<!-- PAGE CONTENT -->
<div class="container py-5">
  <div class="row g-5 align-items-start">

    <!-- LEFT: IMAGE -->
    <div class="col-md-6 text-center">
      <img src="yellowPage2.png" class="product-image" alt="Camera">
    </div>

    <!-- RIGHT: DETAILS -->
    <div class="col-md-6">
      <h2 class="fw-bold">Rhad Yellow Series</h2>

      <p class="price">59.99 $</p>

      <label class="form-label">MODEL:</label>
      <select class="form-select w-auto mb-3">
        <option selected>Select Model</option>
        <option>Body Only</option>
        <option>With 24–50mm Lens</option>
        <option>With 24–105mm Lens</option>
      </select>

      <p class="text-danger fw-semibold">Out of Stock</p>

      <button class="add-btn">ADD TO CART</button>

      <!-- SPECS -->
      <div class="mt-4">
        <p class="spec-label">Material:</p>
        <p>Magnesium alloy + polycarbonate construction</p>

        <p class="spec-label">Sensor:</p>
        <p>Full-frame CMOS 24.2MP</p>

        <p class="spec-label">Lens Mount:</p>
        <p>Yellow RF Mount</p>

        <p class="spec-label">Approx Dimensions:</p>
        <p>132 x 90 x 70 mm</p>
      </div>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
