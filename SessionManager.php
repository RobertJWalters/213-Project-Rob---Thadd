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