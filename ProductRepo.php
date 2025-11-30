<?php

class ProductRepo implements Repo
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function findProductByID($id)
    {
        $query = "SELECT * FROM products WHERE product_id = ? LIMIT 1";
        $stmt = $this->database->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        $row = $res->fetch_assoc();

        return new ProductClass(
            $row['product_id'],
            $row['name'],
            $row['description'],
            $row['price'],
            $row['category'],
            $row['stock_quantity']
        );
    }

    public function findAll(): array
    {
        $query = "SELECT * FROM products ORDER BY product_id";
        $stmt = $this->database->prepare($query);
        $stmt->execute();
        $res = $stmt->get_result();
        $rows = $res->fetch_all(MYSQLI_ASSOC);

        $products = [];
        foreach ($rows as $row) {
            $products[] = new ProductClass(
                $row['product_id'],
                $row['name'],
                $row['description'],
                $row['price'],
                $row['category'],
                $row['stock_quantity']
            );
        }
        return $products;
    }

    public function findByCategory($category): array
    {
        $query = "SELECT * FROM products WHERE category = ? ORDER BY product_id";
        $stmt = $this->database->prepare($query);
        $stmt->bind_param("s", $category);
        $stmt->execute();
        $res = $stmt->get_result();
        $rows = $res->fetch_all(MYSQLI_ASSOC);

        $products = [];
        foreach ($rows as $row) {
            $products[] = new ProductClass(
                $row['product_id'],
                $row['name'],
                $row['description'],
                $row['price'],
                $row['category'],
                $row['stock_quantity']
            );
        }
        return $products;
    }
}
