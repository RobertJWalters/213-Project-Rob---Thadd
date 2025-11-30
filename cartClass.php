<?php


class CartClass
{
    private $items = []; // product_id => quantity

    public function __construct($items = null)
    {
        if ($items !== null) {
            $this->items = $items;
        }
    }

    // Add a product (increase quantity if exists)
    public function addItem($productId, $qty = 1)
    {
        if (isset($this->items[$productId])) {
            $this->items[$productId] += $qty;
        } else {
            $this->items[$productId] = $qty;
        }
    }

    // Remove completely
    public function removeItem($productId)
    {
        if (isset($this->items[$productId])) {
            unset($this->items[$productId]);
        }
    }

    // Set quantity (used in cart page updates)
    public function setQuantity($productId, $qty)
    {
        if ($qty <= 0) {
            unset($this->items[$productId]);
        } else {
            $this->items[$productId] = $qty;
        }
    }

    // Get all cart items
    public function getItems()
    {
        return $this->items;
    }

    // Empty cart
    public function clear()
    {
        $this->items = [];
    }

    // Total number of items
    public function getTotalQuantity()
    {
        return array_sum($this->items);
    }
}
