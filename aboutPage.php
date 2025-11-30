<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About</title>

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: #f5f5f5;
      margin: 0;
      padding: 0;
    }

    /* Navbar */
    #navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 30px;
      background: white;
      border-bottom: 1px solid #ddd;
    }

    .logo {
      font-weight: 700;
      font-size: 22px;
    }

    #navbar a {
      margin-left: 15px;
      text-decoration: none;
      font-weight: 500;
      color: #333;
    }

    /* Hero Section */
    .hero {
      height: 260px;
      background: url('Girlwithcamera.png') center/cover no-repeat;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .hero h1 {
      color: white;
      font-size: 3rem;
      font-weight: 700;
      text-shadow: 0 4px 15px rgba(0,0,0,0.45);
    }

    /* Content Section */
    .content {
      max-width: 900px;
      margin: 60px auto;
      background: white;
      padding: 40px 50px;
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    h2 {
      font-weight: 700;
      margin-bottom: 15px;
    }

    p {
      color: #555;
      line-height: 1.6;
      margin-bottom: 25px;
    }
  </style>
</head>

<body>

<!-- Navbar -->
<nav id="navbar">
  <div class="logo">Rhad Cameras</div>

  <div>
    
    <?php if(!isset($_SESSION['user'])): ?>
      <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
    <?php else: ?>
      <span>Welcome, <?php echo $_SESSION['user']; ?></span>
      <a href="index.php">Home</a>
      <a href="logout.php">Logout</a>
    <?php endif; ?>
  </div>
</nav>

<!-- Hero Section -->
<section class="hero">
  <h1>About Rhad Cameras</h1>
</section>

<!-- Main Content -->
<div class="content">
  <h2>Who We Are</h2>
  
  <h2>Our Mission</h2>
  
</div>

</body>
</html>
