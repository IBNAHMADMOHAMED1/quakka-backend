<?php


class Payment extends Model
{
    public function __construct()
    {
        $this->table = 'payments';

        $this->getConnection();
    }

    public function createPayment($data)
    {
        $sql = "INSERT INTO $this->table (client_id,amount) VALUES (:client_id,:amount)";
        $stmt = $this->_connexion->prepare($sql);
        $stmt->bindValue(':client_id', $data['client_id']);
        $stmt->bindValue(':amount', $data['amount']);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}   