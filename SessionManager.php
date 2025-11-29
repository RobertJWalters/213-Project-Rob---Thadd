<?php

class SessionManager{
    private $user;

    public function __construct(){
        $this->user = new UserClass(null, "Guest", []);
    }


    public function addToCart($product){
        $this->user->addToCart($product);
    }

    public function getCart(){
        return $this->user->getCart();
    }
}
echo "<form method='POST' action='add_to_cart.php'>
                <input type='hidden' name='redirect_to' value='". 'productPage.php?id=' . $productItem->getId() ."'>
<button class='add-btn' type='submit'>ADD TO CART</button>
</form>";