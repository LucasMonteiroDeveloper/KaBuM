<?php

class adminController extends controller
{
    public function __construct() 
    {
        $this->checkLogin();
    }

    public function index() 
    {
        $adminModel = new Admin();
        $dados['clients'] = $adminModel->getClients();

        foreach ($dados['clients'] as &$client) {
            if (isset($client['Date_Birth'])) {
                $client['Date_Birth'] = date('d/m/Y', strtotime($client['Date_Birth']));
            }
        }

        $this->loadTemplate('admin', $dados);
    }

    public function filters() 
    {
        $adminModel = new Admin();
        $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
        $clients = $adminModel->getClients($searchQuery);
    
        foreach ($clients as &$client) {
            if (isset($client['Date_Birth'])) {
                $client['Date_Birth'] = date('d/m/Y', strtotime($client['Date_Birth']));
            }
        }

        echo json_encode(['clients' => $clients]);
    }

    public function getClients() 
    {
        $data = $_GET['id'];
        $adminModel = new Admin();
        $clients = $adminModel->getClientsById($data);
        $addresses = $adminModel->getAddressesByClientId($data);        
        echo json_encode(['client' => $clients, 'addresses' => $addresses]);
    }

    public function addClient() 
    {
        $data = $_POST;
        $adminModel = new Admin();
        $id = $adminModel->addClient($data['client']);

        if (!empty($data['addresses'])) {
            foreach ($data['addresses'] as $address) {
                $adminModel->addAddress($id, $address);
            }
        }

        $data['client']['id'] = $id;
        echo json_encode($data['client']);
    }

    public function updateClient() 
    {
        $data = json_decode(file_get_contents("php://input"), true);
    
        if (!is_array($data)) {
            echo json_encode(['error' => 'Dados inválidos.']);
            return;
        }
    
        $clientData = $data['client'];
        $addressesData = $data['addresses'];
        
        $adminModel = new Admin();
        
        $updatedData = $adminModel->updateClient($clientData);
        
        if (!empty($clientData['IdClient'])) {
            $adminModel->deleteAddresses($clientData['IdClient']);
        }
    
        if (!empty($addressesData)) {
            foreach ($addressesData as $address) {
                $adminModel->addAddress($clientData['IdClient'], $address);
            }
        }
    
        echo json_encode($updatedData);
    }


    public function deleteClient() 
    {
        $data = $_POST;
        $adminModel = new Admin();
        $result = $adminModel->deleteClient($data['id']);
        echo json_encode($result);
    }

    public function deleteAddress() 
    {
        $data = $_POST;
        $adminModel = new Admin();
        $result = $adminModel->deleteAddress($data['id']);
        echo json_encode($result);
    }
}
