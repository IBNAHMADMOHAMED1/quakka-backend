<?php

class Shipping extends Model
{
    public function __construct()
    {
        $this->table = 'shippingsDetails';
        $this->getConnection();
    }
    public function createShippingOtherDetails($data)
    {  
        $sql = "INSERT INTO $this->table (shipping_name,email,phone,mailing_address,city,postal_code,country) VALUES (:shipping_name,:email,:phone,:mailing_address,:city,:postal_code,:country)";
        $stmt = $this->_connexion->prepare($sql);
        $stmt->bindValue(':shipping_name', $data['shipping_name']);
        $stmt->bindValue(':email', $data['email']);
        $stmt->bindValue(':phone', $data['phone']);
        $stmt->bindValue(':mailing_address', $data['mailing_address']);
        $stmt->bindValue(':city', $data['city']);
        $stmt->bindValue(':postal_code', $data['postal_code']);
        $stmt->bindValue(':country', $data['country']);
        if ($stmt->execute()) {
            return $this->_connexion->lastInsertId();
        }
        else {
            return false;
        }
    }

}