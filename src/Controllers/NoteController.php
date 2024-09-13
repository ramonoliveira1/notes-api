<?php

namespace App\Controllers;

use App\Database\Database;
use App\Models\Note;
use PDO;

class NoteController
{
    private $db;
    private $note;

    public function __construct()
    {
        $this->db = (new Database())->connect();
        $this->note = new Note($this->db);
    }

    public function createNote($data)
    {
        $this->note->name = $data['name'];
        $this->note->email = $data['email'];
        $this->note->phone = $data['phone'];
        $this->note->message = $data['message'];
        $this->note->deceased_id = $data['deceased_id'];
        if ($this->note->create()) {
            return ['message' => 'Note created'];
        }
        return ['message' => 'Note not created'];
    }

    public function getNotes()
    {
        $result = $this->note->readAll();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNoteById($id)
    {
        $result = $this->note->readById($id);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteNote($data)
    {
        $this->note->id = $data['id'];
        if ($this->note->delete()) {
            return ['message' => 'Note deleted'];
        }
        return ['message' => 'Note not deleted'];
    }

    public function getNotesByDeceased($id)
    {
        $result = $this->note->readByDeceased($id);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}