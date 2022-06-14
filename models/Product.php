<?php


class Product extends Model
{
    public function __construct()
    {
        $this->table = 'products';

        $this->getConnection();
    }   

    public function create($data)
    {
        $sql = "INSERT INTO products (name, description, price, quantity, category_id, created_at) VALUES (:name, :description, :price, :quantity, :category_id, NOW())";
        $stmt = $this->_connexion->prepare($sql);
        $stmt->bindValue(':name', $data['name']);
        $stmt->bindValue(':description', $data['description']);
        $stmt->bindValue(':price', $data['price']);
        $stmt->bindValue(':quantity', $data['quantity']);
        $stmt->bindValue(':category_id', $data['category_id']);
        
        if ($stmt->execute()) { 
            return $this->_oneProduct($this->_connexion->lastInsertId());
        } else {
            return false;
        }
    }

    public function get_products_with_images()
    {
        // body
    }
    public function _oneProduct($id)
    {
        $sql = "SELECT * FROM products WHERE product_id = :id";
        $stmt = $this->_connexion->prepare($sql);
        $stmt->bindValue(':id', $id);
        if ($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }
    
    public function update($id, $data)
    {
        $sql = "UPDATE products SET name = :name, description = :description, price = :price, quantity = :quantity, category_id = :category_id ,created_at = NOW() WHERE product_id = :id";
        $stmt = $this->_connexion->prepare($sql);
        $stmt->bindValue(':name', $data['name']);
        $stmt->bindValue(':description', $data['description']);
        $stmt->bindValue(':price', $data['price']);
        $stmt->bindValue(':quantity', $data['quantity']);
        $stmt->bindValue(':category_id', $data['category_id']);
        $stmt->bindValue(':id', $id);
        if ($stmt->execute()) {
            return $this->_oneProduct($id);
        } else {
            return false;
        }
    }
    public function _deleteProduct($id) {
        $sql = "DELETE FROM products WHERE product_id = :id";
        $stmt = $this->_connexion->prepare($sql);
        $stmt->bindValue(':id', $id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function updateProduct($data, $newQuantity)
    {
        $sql = "UPDATE products SET quantity = :quantity WHERE product_id = :id";
        $stmt = $this->_connexion->prepare($sql);
        $stmt->bindValue(':quantity', $newQuantity);
        $stmt->bindValue(':id', $data['product_id']);
        if ($stmt->execute()) {
            return $this->_oneProduct($data['product_id']);
        } else {
            return false;
        }
    }
}