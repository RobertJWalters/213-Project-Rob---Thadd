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


    public function insertProduct($id, $name, $desc, $price, $category, $stockQuantity){
        $query = "INSERT INTO products (product_id, name, description, price, category, quantity) VALUES
(?, ?, ?, ?, ?, ?), ";
        $stmt = $this->database->prepare($query);
        $stmt->execute();
//        $res = $stmt->get_result();
        //if $res failed, return something
// if (!$stmt) {
//            $error = 'Prepare failed: ' . $mysqli->error;
//        } else {
//            $stmt->bind_param('sss', $name, $email, $message);
//            if ($stmt->execute()) {
//                $success = 'Contact inserted successfully!';
//            } else {
//                if ($mysqli->errno == 1062) { // duplicate key
//                    $error = 'Email already exists. Try a different one.';
//                } else {
//                    $error = 'Insert failed: ' . $mysqli->error;
//                }
//            }
//            $stmt->close();
//        }

    }

    public function updateProductStockQuantity($product_id, $newQuantity){
        $query = "UPDATE products SET stock_quantity = ? WHERE product_id = ?";
        // $stmt = $mysqli->prepare($sql);
        //        if (!$stmt) {
        //            $error = 'Prepare failed: ' . $mysqli->error;
        //        } else {
        //            $stmt->bind_param('sss', $name, $message, $email);
        //            if ($stmt->execute()) {
        //                if ($stmt->affected_rows > 0) {
        //                    $success = 'Record updated successfully.';
        //                } else {
        //                    $error = 'No changes made or record not found.';
        //                }
        //            } else {
        //                $error = 'Update failed: ' . $mysqli->error;
        //            }
        //            $stmt->close();
        //        }
    }

    public function delete($id)
    {
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $this->database->prepare($query);
        return $stmt->execute([$id]);  //is this right?
    }

}
