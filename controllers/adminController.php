<?php

class adminController extends controller
{
    public function index() {
        $adminModel = new Admin();
        $dados['clients'] = $adminModel->getClients();
        $this->loadTemplate('admin', $dados);
    }

    public function getClients() {
        $adminModel = new Admin();
        $clients = $adminModel->getClients();
        echo json_encode($clients);
    }

    public function addClient() {
        $data = json_decode(file_get_contents("php://input"), true);
        $adminModel = new Admin();
        $id = $adminModel->addClient($data);
        $data['id'] = $id;
        echo json_encode($data);
    }

    public function updateClient() {
        $data = json_decode(file_get_contents("php://input"), true);
        $adminModel = new Admin();
        $updatedData = $adminModel->updateClient($data);
        echo json_encode($updatedData);
    }

    public function deleteClient() {
        $data = json_decode(file_get_contents("php://input"), true);
        $adminModel = new Admin();
        $result = $adminModel->deleteClient($data['id']);
        echo json_encode($result);
    }
}
