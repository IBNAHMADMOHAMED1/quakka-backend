<?php


class Admin extends Model
{

    public function __construct()
    {
        $this->table = 'admins';

        $this->getConnection();
    }
    /* Retourne un article en fonction de son slug
     *
     * @param string $slug
     * @return void
     */

    public function login($data)
    {
        
        $sql = "SELECT * FROM admins WHERE email = :email AND password = :password";
        $stmt = $this->_connexion->prepare($sql);
        $stmt->bindValue(':email', $data['email']);
        $stmt->bindValue(':password', $data['password']);
        
        if ($stmt->execute()) {
            $admin = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($admin) {
                return $admin;
            } else {
                return false;
            }
        }
    }

    public function profile($id)
    {
        $sql = "SELECT * FROM admins WHERE id = :id";
        $stmt = $this->_connexion->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($admin) {
            return $admin;
        } else {
            return false;
        }
    }
    public function update($id,$data)
    {
        $sql = "UPDATE admins SET  nom = :nom, email = :email, password = :password, avatar = :avatar, cover_photo = :cover_photo WHERE id = :id";
        $stmt = $this->_connexion->prepare($sql);
        $stmt->bindValue(':nom', $data['nom']);
        $stmt->bindValue(':email', $data['email']);
        $stmt->bindValue(':password', $data['password']);
        $stmt->bindValue(':avatar',$data['avatar']);
        $stmt->bindValue(':cover_photo',$data['cover_photo']);
        $stmt->bindValue(':id', $id);
        
        if ($stmt->execute()) {
            $admin = $this->profile($id);
            return $admin;
            
        }
        else return false;

    }



}

