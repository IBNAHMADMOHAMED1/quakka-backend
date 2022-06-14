<?php


class User extends Model
{
    public function __construct()
    {
        $this->table = 'clients';

        $this->getConnection();
    }
   
    public function login($data)
    {
        // die(var_dump($data));
        
        $sql = "SELECT * FROM $this->table WHERE email = :email AND password = :password";
        $stmt = $this->_connexion->prepare($sql);
        $stmt->bindValue(':email', $data['email']);
        $stmt->bindValue(':password', $data['password']);
        if ($stmt->execute()) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user) {
                return $user;
            } else {
                return false;
            }
        }
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
  
}