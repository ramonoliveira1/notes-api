<?php

use App\Controllers\NoteController;

$noteController = new NoteController();

$requestMethod = $_SERVER["REQUEST_METHOD"];
$id = $_GET['id'] ?? null;

switch ($requestMethod) {
    case 'GET':
        if ($id) {
            echo json_encode($noteController->getNoteById($id));
            break;
        }
        echo json_encode($noteController->getNotes());
        break;
    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode($noteController->createNote($data));
        break;
    case 'DELETE':
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode($noteController->deleteNote($data));
        break;
    default:
        break;
}