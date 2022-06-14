<?php

class Order extends Model
{
    public function __construct()
    {
        $this->table = 'orders';

        $this->getConnection();
    }
    public function createOrder($data)
    {
        
        for ($i = 0; $i < count($data['list_of_products']); $i++) {
            $ids = implode(',', $data['list_of_products'][$i]);
            
            $sql = "INSERT INTO $this->table (client_id,shipping_id,total_amount,list_of_products) VALUES (:client_id,:shipping_id,:total_amount,:list_of_products)";
            $stmt = $this->_connexion->prepare($sql);
            $stmt->bindValue(':client_id', $data['client_id']);
            $stmt->bindValue(':shipping_id', $data['shipping_id']);
            $stmt->bindValue(':total_amount', $data['total_amount']);
            $stmt->bindValue(':list_of_products', $ids);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
          
        }

        

      
    }
    public function createListOfProducts($data)
    {

        $this->table = 'list_of_products';
        // print_r($data);
        // die();
        $sql = "INSERT INTO $this->table (client_id,product_id,quantity,create_at) VALUES ";
        for ($i=0; $i < count($data); $i++) { 
            $sql .= "(?,?,?,NOW()),";
        }

        $sql = substr($sql, 0, -1);

        $params =[];
        

        foreach ($data as $product){
            $params[] = $product['client_id'];
            $params[] = $product['product_id'];
            $params[] = $product['quantity'];
        }

            $stmt = $this->_connexion->prepare($sql);
            if (!$stmt->execute($params)) {
                return false;
            }
            else {
                $sql = "UPDATE Products SET quantity = quantity - :quantity WHERE product_id = :product_id";
                $stmt = $this->_connexion->prepare($sql);
                $stmt->bindValue(':quantity', $product['quantity']);
                $stmt->bindValue(':product_id', $product['product_id']);
                if (!$stmt->execute()) {
                    return false;
                }
                else {
                   
                    $sql = "SELECT id FROM list_of_products WHERE create_at = NOW()";
                    $stmt = $this->_connexion->prepare($sql);
                    // $stmt->bindValue(':create_at', $create_at[0]['create_at']);
                    $stmt->execute();
                    $ids = $stmt->fetchAll(PDO::FETCH_ASSOC);
                   return $ids;
                    
                }
    
             
            }
        
    }
    public function lastOneId()
    {
        $this->table = 'list_of_products';
        $sql = "SELECT MAX(id) FROM $this->table";
        $stmt = $this->_connexion->prepare($sql);
        if ($stmt->execute()) {
            $obj= $stmt->fetch(PDO::FETCH_ASSOC);
            return $obj['MAX(id)'];
        } else {
            return false;
        }
    }

    public function getListOfProducts($list_of_products)
    {
        // die(print_r($list_of_products));
       
        $this->table = 'list_of_products';
        $sql = "SELECT * FROM $this->table WHERE id IN ($list_of_products)";
        $stmt = $this->_connexion->prepare($sql);
        if ($stmt->execute()) {
             $list1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
             var_dump($list1[0]['create_at']);
              die();
            $sql = "SELECT * FROM $this->table WHERE create_at = :create_at";
            $stmt = $this->_connexion->prepare($sql);
            $stmt->bindValue(':create_at', $list1[0]['create_at']);
            if ($stmt->execute()) {
                $list2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $list = array_merge($list1, $list2);
                return $list;
            }
            else {
                return false;
            }

        } else {
            return false;
        }
    }
    public function getallOrders()
    {
        // get with clients use relationship with clients table
        $this->table = 'orders';
        $sql = "SELECT * FROM $this->table as o INNER JOIN clients as c o INNER JOIN shipping as s o INNER JOIN list_of_products as l ON o.id = l.list_of_products WHERE o.client_id = c.id AND o.shipping_id = s.id";
        $stmt = $this->_connexion->prepare($sql);
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }

    }
    
}