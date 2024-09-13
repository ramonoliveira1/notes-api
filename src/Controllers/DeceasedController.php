<?php

namespace App\Controllers;

use App\Database\Database;
use App\Models\Deceased;
use PDO;

class DeceasedController
{
    private $db;
    private $deceased;
    
    private $noteController;

    public function __construct()
    {
        $this->db = (new Database())->connect();
        $this->deceased = new Deceased($this->db);
        $this->noteController = new NoteController();
    }

    public function getDeceaseds()
    {
        $result = $this->deceased->readAll();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDeceasedById($id)
    {
        $deceased = $this->deceased->readById($id);
        $deceased = $deceased->fetch(PDO::FETCH_ASSOC);
        $deceased['notes'] = $this->noteController->getNotesByDeceased($id);
        return $deceased;
    }

    public function createDeceased($data)
    {
        $this->deceased->name = $data['name'];
        $this->deceased->death_date = $data['death_date'];
        $this->deceased->birth_date = $data['birth_date'];
        $this->deceased->enterprise_id = $data['enterprise_id'];
        if ($this->deceased->create()) {
            return ['message' => 'Deceased created'];
        }
        return ['message' => 'Deceased not created'];
    }

    public function deleteDeceased($data)
    {
        $this->deceased->id = $data['id'];
        if ($this->deceased->delete()) {
            return ['message' => 'Deceased deleted'];
        }
        return ['message' => 'Deceased not deleted'];
    }
}