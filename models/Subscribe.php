<?php


class Subscribe extends Model
{
    public function __construct()
    {
        $this->table = 'subscribes';

        $this->getConnection();
    }
    
    public function createSubscribe($data)
    {
        $sql = "INSERT INTO $this->table (email) VALUES (:email)";
        $stmt = $this->_connexion->prepare($sql);
        $stmt->bindValue(':email', $data['email']);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}