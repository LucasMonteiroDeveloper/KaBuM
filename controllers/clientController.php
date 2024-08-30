<?php
require ('../models/client.php');

class ClientController extends Controller 
{
    private $clientModel;

    public function __construct() {
        $this->clientModel = new Client();
    }

    public function getClients() {
        header('Content-Type: application/json');        
        echo json_encode($this->clientModel->getAllClients());
    }

    public function addClient() {
        $data = json_decode(file_get_contents("php://input"), true);
        header('Content-Type: application/json');
        $clientId = $this->clientModel->addClient($data);
        echo json_encode($this->clientModel->getClientById($clientId));
    }

    public function updateClient() {
        $data = json_decode(file_get_contents("php://input"), true);
        header('Content-Type: application/json');
        $this->clientModel->updateClient($data);
        echo json_encode($this->clientModel->getClientById($data['id']));
    }

    public function deleteClient() {
        $data = json_decode(file_get_contents("php://input"), true);
        header('Content-Type: application/json');
        $this->clientModel->deleteClient($data['id']);
    }
}
