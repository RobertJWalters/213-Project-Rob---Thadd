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

    public function addProduct(ProductClass $product, $qty = 1) {
        $id = $product->getId();
        if (isset($this->products[$id])) {
            $this->products[$id]['quantity'] += $qty;
        } else {
            $this->products[$id] = [
                "product" => $product,
                "quantity" => $qty
            ];
        }
    }


    public function removeProduct(ProductClass $product){
        $id = $product->getId();
        if(isset($this->products[$id])){
            $this->products[$id]['quantity'] = 0;
            unset($this->products[$id]);
        }
    }

    public function decreaseProductQty(ProductClass $product){
        $id = $product->getId();
        if(isset($this->products[$id])){
            if($this->products[$id]['quantity'] === 1){
                $this->removeProduct($product);
            }else {
                $this->products[$id]['quantity']--;
            }
        }
    }

}