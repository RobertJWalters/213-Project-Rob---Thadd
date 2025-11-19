<?php
class Product
{
    private $name;
    private $id;

    private $price;
    private $category;
    private $desc;
    public function __construct($id, $name, $desc, $price, $category)
    {
        $this->name = $name;
        $this->id = $id;
        $this->price = $price;
        $this->category = $category;
        $this->desc = $desc;
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

}
