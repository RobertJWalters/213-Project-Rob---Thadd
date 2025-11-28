<?php
class ProductRepo implements Repo{

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
                $row['category'],
                $row['stock_quantity']
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
                $row['category'],
                $row['stock_quantity']
            );
        }
        return $products;
    }


    public function insertProduct($name, $desc, $price, $category, $stockQuantity){
        $query = "INSERT INTO products (name, description, price, category, stock_quantity) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->database->prepare($query);
        $stmt->bind_param("sssii", $name, $desc, $price, $category, $stockQuantity);
        $stmt->execute();
    }

    public function updateProductStockQuantity($product_id, $newQuantity){
        $query = "UPDATE products SET stock_quantity = ? WHERE product_id = ?";
        $stmt = $this->database->prepare($query);
        $stmt->bind_param("ii", $newQuantity, $product_id);
        $stmt->execute();
    }

    public function delete($id)
    {
        $query = "DELETE FROM products WHERE product_id = ?";
        $stmt = $this->database->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();  //is this right?
    }

}
