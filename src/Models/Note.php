<?php

namespace App\Models;

class Note
{
    private $conn;
    private $table = 'notes';
    public $id;
    public $name;
    public $email;
    public $phone;
    public $message;
    public $deceased_id;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        $query = "INSERT INTO $this->table (name, email, phone, message, deceased_id) VALUES (:name, :email, :phone, :message, :deceased_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':message', $this->message);
        $stmt->bindParam(':deceased_id', $this->deceased_id);
        return $stmt->execute();
    }

    public function read()
    {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function delete()
    {
        $query = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }
}