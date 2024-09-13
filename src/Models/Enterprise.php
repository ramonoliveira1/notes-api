<?php

namespace App\Models;

class Enterprise
{
    private $conn;
    private $table = 'enterprises';
    public $id;
    public $name;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create()
    {
        $query = 'INSERT INTO ' . $this->table . ' SET name = :name';
        $stmt = $this->conn->prepare($query);
        $this->name = htmlspecialchars(strip_tags($this->name));
        $stmt->bindParam(':name', $this->name);
        if ($stmt->execute()) {
            http_response_code(201);
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function delete()
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);
        if ($stmt->execute()) {
            http_response_code(200);
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
}