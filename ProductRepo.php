<?php
class ProductRepo{

    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function findAll()
    {
        $query = "SELECT * FROM products ORDER BY product_id DESC";
        $stmt = $this->database->prepare($query);
        $stmt->execute();
        $res = $stmt->get_result();
        $rows = $res->fetch_all(MYSQLI_ASSOC);

        $products = [];
        foreach ($rows as $row) {
            $products[] = new Product(
                $row['product_id'],
                $row['name'],
                $row['description'],
                $row['price'],
                $row['category']
            );
        }
        return $products;
    }

}
