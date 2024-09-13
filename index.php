<?php
require __DIR__ . '/vendor/autoload.php';

$route = $_SERVER['REQUEST_URI'];

switch ($route) {
    case '/passing-notes/':
        echo json_encode(['message' => 'Welcome to Form Nota API']);
        break;
    case str_contains($route, '/passing-notes/note'):
        require __DIR__ . '/src/Routes/NoteRoutes.php';
        break;
    case str_contains($route, '/passing-notes/deceased'):
        require __DIR__ . '/src/Routes/DeceasedRoutes.php';
        break;
    case str_contains($route, '/passing-notes/enterprise'):
        require __DIR__ . '/src/Routes/EnterpriseRoutes.php';
        break;
    default:
        http_response_code(404);
        echo json_encode(['error' => 'Not Found']);
        break;
}