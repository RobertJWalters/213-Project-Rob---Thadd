<?php

class UserClass
{
    private $email;
    private $name;
    private $cart;
    private $phone;
    private $address;

    public function __construct($email, $name, $cart){
        $this->email = $email;
        $this->name = $name;
        $this->cart = $cart;
    }

    public function getEmail(){
        return $this->email;
    }
    public function getName(){
        return $this->name;
    }
    public function getCart(){
        return $this->cart;  //check?
    }

    public function addToCart($product){
            $this->cart = [ $product => 1 ];
    }


}