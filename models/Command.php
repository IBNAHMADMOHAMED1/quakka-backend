<?php

class Command extends Model
{
    public function __construct()
    {
        $this->table = 'commands';
        $this->getConnection();
    }
    public function getall()
    {
        $sql = "SELECT * FROM commands";
        $stmt = $this->_connexion->prepare($sql);
        $stmt->execute();
        $commands = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($commands) {
            return $commands;
        } else {
            return false;
        }
    }

    public function createCommandHall($data)
    {
        $sql = "INSERT INTO commands (client_id, hall_id,
         date_arrival, date_departure,
         created_at) VALUES (:id_client, :id_hall,:date_arrival, :date_departure, NOW())";
        $stmt = $this->_connexion->prepare($sql);
        $stmt->bindParam(':id_client', $data['id_client']);
        $stmt->bindParam(':id_hall', $data['id_hall']);
        $stmt->bindParam(':date_arrival', $data['date_arrival']);
        $stmt->bindParam(':date_departure', $data['date_departure']);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function delete($id)
    {
        $sql = "DELETE FROM commands WHERE id = :id";
        $stmt = $this->_connexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
public function updatestatus($id,$value)
{
    $sql = "UPDATE commands SET status = $value WHERE id = :id";
    $stmt = $this->_connexion->prepare($sql);
    $stmt->bindParam(':id', $id);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }

}
 
}