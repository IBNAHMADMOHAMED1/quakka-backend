<?php


class Imagehall extends Model
{
    public function __construct()
    {
        $this->table = 'HallImags';
        $this->getConnection();
    }

    public function upload_images($id, $images)
    {
        $id = (int)$id;
        $sutupla = [];
        foreach ($images as $image) {
            $sql = "INSERT INTO $this->table  (name, idHall) VALUES (:name, :idHall)";
            $stmt = $this->_connexion->prepare($sql);
            $stmt->bindValue(':name', $image);
            $stmt->bindValue(':idHall', $id);
            if ($stmt->execute()) {
                array_push($sutupla, true);
            } else {
                array_push($sutupla, false);
            }
        }
        if (in_array(false, $sutupla)) {
            return false;
        } else {
            return true;
        }
    }
    public function get_images_with_products()
    {
        $sql = "SELECT * FROM $this->table LEFT JOIN halls ON $this->table.idHall  = products.product_id";
        $stmt = $this->_connexion->prepare($sql);
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }
    public function _getImages($idHall) {
        $sql = "SELECT * FROM $this->table WHERE idHall  = $idHall ";
        $stmt = $this->_connexion->prepare($sql);
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function _delete_images($idHall) 
    {   
        // check if the image is in the database
        $sql = "SELECT * FROM $this->table WHERE idHall  = $idHall ";
        $stmt = $this->_connexion->prepare($sql);
        if ($stmt->execute()) {
            $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($images) > 0) {
                $sql = "DELETE FROM $this->table WHERE idHall  = $idHall ";
                $stmt = $this->_connexion->prepare($sql);
                if ($stmt->execute()) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        } else {
            return false;
        }

    }
}
