<?php

namespace App\Controllers;

use App\Database\Database;
use App\Models\Deceased;
use PDO;

class DeceasedController
{
    private $db;
    private $deceased;

    public function __construct()
    {
        $this->db = (new Database())->connect();
        $this->deceased = new Deceased($this->db);
    }

    public function getDeceaseds()
    {
        $result = $this->deceased->read();
        return $result->fetchAll(PDO::FETCH_ASSOC);
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