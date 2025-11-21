<?php
class ProductRepo{

    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function findProductByID($id){
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
                $row['category']
        );
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
            $products[] = new ProductClass(
                $row['product_id'],
                $row['name'],
                $row['description'],
                $row['price'],
                $row['category']
            );
        }
        return $products;
    }

    //Maybe add find all of certain category functions?

}
