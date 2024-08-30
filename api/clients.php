<?php
require '../models/Admin.php';

$adminModel = new Admin();
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $clients = $adminModel->getClients();
        echo json_encode($clients);
        break;
    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'add':
                    $id = $adminModel->addClient($data);
                    $data['id'] = $id;
                    echo json_encode($data);
                    break;
                case 'update':
                    $updatedData = $adminModel->updateClient($data);
                    echo json_encode($updatedData);
                    break;
                case 'delete':
                    $result = $adminModel->deleteClient($data['id']);
                    echo json_encode($result);
                    break;
            }
        }
        break;
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
        break;
}
