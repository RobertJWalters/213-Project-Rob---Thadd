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
    <link rel="stylesheet" href="./styles.css">
    <link rel="stylesheet" href="cart.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 0;
        }

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

<?php include 'navbar.php'; ?>

<!-- Hero Section -->
<section class="hero">
    <h1>About Rhad Cameras</h1>
</section>

<!-- Main Content -->
<div class="content">
    <h2>Who We Are</h2>
    <p>Rhad Cameras is a small camera brand focused on simple, reliable gear built for all creators.
        We design cameras that deliver strong performance without unnecessary complexity.</p>
    <h2>Our Mission</h2>
    <p>We build cameras for creators who take their craft seriously -
    premium design, built to deliver excellence in every shot.</p>
</div>
<?php include 'loginModal.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
