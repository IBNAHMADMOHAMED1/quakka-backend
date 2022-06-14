<?php


class Category extends Model
{
    public function __construct()
    {
        $this->table = 'categorys';

        $this->getConnection();
    }

    public function create($data)
    {
        
        $sql = "INSERT INTO $this->table  (name, description, created_at) VALUES (:name, :description,NOW())";
        $stmt = $this->_connexion->prepare($sql);
        $stmt->bindValue(':name', $data['name']);
        $stmt->bindValue(':description', $data['description']);
       if ($stmt->execute()) {
            return $this->getAll();
        } else {
            return false;
        }

    }
    public function _getCategory($product_id)
    {
        $sql = "SELECT * FROM $this->table WHERE category_id = :category_id";
        $stmt = $this->_connexion->prepare($sql);
        $stmt->bindValue(':category_id', $product_id);
        if ($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }
    public function _geOne($id)
    {
        $sql = "SELECT * FROM $this->table WHERE category_id = :category_id";
        $stmt = $this->_connexion->prepare($sql);
        $stmt->bindValue(':category_id', $id);
        if ($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    
}   