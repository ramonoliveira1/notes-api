<?php

use App\Controllers\DeceasedController;

$deceasedController = new DeceasedController();

$requestMethod = $_SERVER["REQUEST_METHOD"];

switch ($requestMethod) {
    case 'GET':
        echo json_encode($deceasedController->getDeceaseds());
        break;
    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode($deceasedController->createDeceased($data));
        break;
    case 'DELETE':
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode($deceasedController->deleteDeceased($data));
        break;
    default:
        break;
}