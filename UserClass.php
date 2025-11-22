<?php

class UserClass
{
    private $id; //email as ID?
    private $name;
    private $cart;
    private $email;
    private $phone;
    private $address;

    public function __construct($id, $name, $cart){
        $this->id = $id;
        $this->name = $name;
        $this->cart = $cart;
    }

    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
    public function getCart(){
        return $this->cart;  //check?
    }


}