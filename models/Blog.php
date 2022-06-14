<?php

class Blog extends Model
{
    public function __construct()
    {
        $this->table = 'blogs';
        $this->getConnection();
    }
    public function getall()
    {
        $sql = "SELECT * FROM blogs";
        $stmt = $this->_connexion->prepare($sql);
        $stmt->execute();
        $blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($blogs) {
            return $blogs;
        } else {
            return false;
        }
    }
    public function create($data)
    {
        $sql = "INSERT INTO blogs (title, content, created_at) VALUES (:title, :content, NOW())";
        $stmt = $this->_connexion->prepare($sql);
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':content', $data['content']);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}