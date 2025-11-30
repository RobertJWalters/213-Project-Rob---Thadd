<?php
class ProductClass
{
    private $name;
    private $id;
    private $price;
    private $category;
    private $desc;
<<<<<<<< HEAD:ProductClass.php
    private $stockQuantity;

    public function __construct($id, $name, $desc, $price, $category, $stockQuantity)
    {
========

    public function __construct($name, $id,
                                $price = 0,
                                $category="none",
                                $desc="Description missing"){
>>>>>>>> origin/Thadd:Product.php
        $this->name = $name;
        $this->id = $id;
        $this->price = $price;
        $this->category = $category;
        $this->desc = $desc;
        $this->stockQuantity = $stockQuantity;
    }

    public function getName(){
        return $this->name;
    }
    public function getId(){
        return $this->id;
    }
    public function getPrice(){
        return $this->price;
    }
    public function getCategory(){
        return $this->category;
    }
    public function getDesc(){
        return $this->desc;
    }
    public function getStockQuantity(){
        return $this->stockQuantity;
    }

<<<<<<<< HEAD:ProductClass.php
    public function setStockQuantity($stockQuantity)
    {
        $this->stockQuantity = $stockQuantity;
    }

    public function incrementStockQuantity(){
        $this->stockQuantity++;
    }

    public function decrementStockQuantity(){
        $this->stockQuantity--;
    }

========
>>>>>>>> origin/Thadd:Product.php
}
