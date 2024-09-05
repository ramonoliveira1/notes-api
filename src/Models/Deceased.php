<?php

namespace App\Models;

class Deceased
{
    private $conn;
    private $table = 'deceaseds';
    public $id;
    public $name;
    public $death_date;
    public $birth_date;
    public $enterprise_id;

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
        $query = 'INSERT INTO ' . $this->table . ' SET name = :name, death_date = :death_date, birth_date = :birth_date, enterprise_id = :enterprise_id';
        $stmt = $this->conn->prepare($query);
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->death_date = htmlspecialchars(strip_tags($this->death_date));
        $this->birth_date = htmlspecialchars(strip_tags($this->birth_date));
        $this->enterprise_id = htmlspecialchars(strip_tags($this->enterprise_id));
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':death_date', $this->death_date);
        $stmt->bindParam(':birth_date', $this->birth_date);
        $stmt->bindParam(':enterprise_id', $this->enterprise_id);
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