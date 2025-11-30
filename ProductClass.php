<?php

class ProductClass
{
    private $id;
    private $name;
    private $desc;
    private $price;
    private $category;
    private $stockQuantity;

    public function __construct($id, $name, $desc, $price, $category, $stockQuantity = 0)
    {
        $this->id = $id;
        $this->name = $name;
        $this->desc = $desc;
        $this->price = $price;
        $this->category = $category;
        $this->stockQuantity = $stockQuantity;
    }

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getDesc(){
        return $this->desc;
    }

    public function getPrice(){
        return $this->price;
    }

    public function getCategory(){
        return $this->category;
    }

    public function getStockQuantity(){
        return $this->stockQuantity;
    }

    public function setStockQuantity($stockQuantity){
        $this->stockQuantity = $stockQuantity;
    }

    public function incrementStockQuantity(){
        $this->stockQuantity++;
    }

    public function decrementStockQuantity(){
        if ($this->stockQuantity > 0) {
            $this->stockQuantity--;
        }
    }
}
