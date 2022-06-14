<?php


class ListOfProduct extends Model
{
    public function __construct()
    {
        $this->table = 'list_of_products';

        $this->getConnection();
    }
    public function createListOfProducts($data)
    {
        $sql = "INSERT INTO $this->table (product_id,quantity) VALUES (:product_id,:quantity)";
        $stmt = $this->_connexion->prepare($sql);
        $stmt->bindValue(':product_id', $data['product_id']);
        $stmt->bindValue(':quantity', $data['quantity']);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getListOfProducts($dataIds)
    {
        $ids = implode(',', $dataIds);
        $sql = "SELECT * FROM list_of_products as lop INNER JOIN products as p ON lop.product_id = p.product_id WHERE lop.id IN (:ids)";
        $stmt = $this->_connexion->prepare($sql);
        $stmt->bindValue(':ids', $ids);
        $stmt->execute();
        $listOfProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($listOfProducts) {
              // select where create_at = create_at of the lislistOfProducts
            $sql = "SELECT * FROM list_of_products WHERE create_at = :create_at";
            $stmt = $this->_connexion->prepare($sql);
            $stmt->bindValue(':create_at', $listOfProducts[0]['create_at']);
            $stmt->execute();
            $ids = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $ids;
        } else {
            return false;
        }
    }
}