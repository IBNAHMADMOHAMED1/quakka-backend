<?php

class Client extends Model
{
    public function __construct()
    {
        $this->table = 'clients';

        $this->getConnection();
    }

    public function create($data)
    {
        // die(var_dump($data));
        $sql = "INSERT INTO `clients`(`username`, `email`, `phoneNumber`, `mailing_address`, `city`, `password`) VALUES (:username,:email,:phoneNumber,:mailing_address,:city,:password)";
        $stmt = $this->_connexion->prepare($sql);
        $stmt->bindValue(':username', $data['username']);
        $stmt->bindValue(':email', $data['email']);
        $stmt->bindValue(':phoneNumber', $data['phoneNumber']);
        $stmt->bindValue(':mailing_address', $data['mailing_address']);
        $stmt->bindValue(':city', $data['city']);
        $stmt->bindValue(':password', $data['password']);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function lastInsertId()
    {
        return $this->_connexion->lastInsertId();
    }
    public function getClient($id)
    {
        $sql = "SELECT * FROM clients WHERE id = :id";
        $stmt = $this->_connexion->prepare($sql);
        $stmt->bindValue(':id', $id);
        if ($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }
    
}