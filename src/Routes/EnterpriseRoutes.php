<?php

use App\Controllers\EnterpriseController;

$enterpriseController = new EnterpriseController();

$requestMethod = $_SERVER["REQUEST_METHOD"];

switch ($requestMethod) {
    case 'GET':
        echo json_encode($enterpriseController->getEnterprises());
        break;
    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        $enterpriseController->createEnterprise($data);
        break;
    case 'DELETE':
        $data = json_decode(file_get_contents("php://input"), true);
        $enterpriseController->deleteEnterprise($data);
        break;
    default:
        break;
}