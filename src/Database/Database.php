<?php

namespace App\Database;

use PDO;
use PDOException;

class Database
{
    private $host = 'localhost';
    private $db = 'u616491472_parquedasflore';
    private $port = 3306;
    private $user = 'u616491472_ti';
    private $pass = 'Holding200824@';
    private $conn;

    public function connect()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->db;charset=utf8", $this->user, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
            exit;
        }
        return $this->conn;
    }
}