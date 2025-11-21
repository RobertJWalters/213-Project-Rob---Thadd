<?php

class CartClass
{
    private $id;

    private $products;  //asc array of products and quantities

    private $customer;

    public function __construct($id, $products, $customer="NoCustomer")
    {
        $this->id = $id;
        $this->products = $products;
        $this->customer = $customer;
    }

    public function getId(){
        return $this->id;
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
        $this->products[] = $product;
    }
}