<?php
//require 'ProductClass.php';
//require 'ProductRepo.php';
//include  'cart.php';
require_once __DIR__ . '/db.php';
$mysqli = db::getDB();
$arrDB = array(12, 3, 5);
//If want no db development
if($mysqli === null) $mysqli = $arrDB; //then include an array database
$prodRepo = new ProductRepo($mysqli);
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
        $data = $prodRepo->findAll(); //change to cart repo
        foreach($data as $d){
            echo "<div class='cart-product'>" .
                    "<img src='prod" . $d->getId() . ".jpg' alt='Product? id' class='cart-product-image'>
                . <h3 class='product-name'>". $d->getName() . "</h3>
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

