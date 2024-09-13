<?php

namespace App\Controllers;

use App\Database\Database;
use App\Models\Enterprise;
use PDO;

class EnterpriseController
{
    private $db;
    private $enterprise;

    public function __construct()
    {
        $this->db = (new Database())->connect();
        $this->enterprise = new Enterprise($this->db);
    }

    public function getEnterprises()
    {
        $result = $this->enterprise->read();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createEnterprise($data)
    {
        $this->enterprise->name = $data['name'];
        if ($this->enterprise->create()) {
            return ['message' => 'Enterprise created'];
        }
        return ['message' => 'Enterprise not created'];
    }

    public function deleteEnterprise($data)
    {
        $this->enterprise->id = $data['id'];
        if ($this->enterprise->delete()) {
            return ['message' => 'Enterprise deleted'];
        }
        return ['message' => 'Enterprise not deleted'];
    }
}