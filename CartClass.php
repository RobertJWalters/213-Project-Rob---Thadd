<?php

class CartClass
{
    private $id;

    private $products;  //asc array of products and quantities

    private $customer;

    public function __construct($customer)
    {
        $this->products = [];
        $this->customer = $customer;
    }

    public function getProducts(){
        return $this->products;
    }

    public function getCustomer(){
        return $this->customer;
    }

    public function getTotalPrice(){
        foreach($this->products as $product){
            $price = $product->getPrice();
        }
    }

    public function addProduct(ProductClass $product){
        $id = $product->getId();
        if(isset($this->products[$id])){
            $this->products[$id]['quantity']++;
        }else{
            $this->products[$id] =[
                "product" => $product,
                "quantity" => 1
            ];
        }

    }

}