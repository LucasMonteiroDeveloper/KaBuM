<?php

class adminController extends controller
{
    public function index() {
        $adminModel = new Admin();
        $dados['clients'] = $adminModel->getClients();

        foreach ($dados['clients'] as &$client) {
            if (isset($client['Date_Birth'])) {
                $client['Date_Birth'] = date('d/m/Y', strtotime($client['Date_Birth']));
            }
        }

        $this->loadTemplate('admin', $dados);
    }

    public function filters() {
        $adminModel = new Admin();
        $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
        $clients = $adminModel->getClients($searchQuery);
    
        foreach ($clients as &$client) {
            if (isset($client['Date_Birth'])) {
                $client['Date_Birth'] = date('d/m/Y', strtotime($client['Date_Birth']));
            }
        }
    
        // Retorna os dados como JSON
        echo json_encode(['clients' => $clients]);
    }

    public function getClients() {
        $data = $_GET['id'];
        $adminModel = new Admin();
        $clients = $adminModel->getClientsById($data);
        $addresses = $adminModel->getAddressesByClientId($data);        
        echo json_encode(['client' => $clients, 'addresses' => $addresses]);
    }

    public function addClient() {
        $data = $_POST;
        $adminModel = new Admin();
        $id = $adminModel->addClient($data['client']);
        if (!empty($data['addresses'])) {
            $adminModel->addAddress($id, $data['addresses']);
        }

        $data['client']['id'] = $id;
        echo json_encode($data['client']);
    }

    public function updateClient() {        
        $data = json_decode(file_get_contents("php://input"), true);

        $clientData = $this->convertToAssociativeArrayClient($data['client']);
        $addressesData = $this->convertToAssociativeArrayAddresses($data['addresses']);
        
        $adminModel = new Admin();
        $updatedData = $adminModel->updateClient($clientData);
        
        if (!empty($clientData['IdClient'])) {
            $adminModel->deleteAddresses($clientData['IdClient']);
        }

        if (!empty($addressesData)) {
            foreach ($addressesData as $address) {
                $adminModel->addAddress($clientData['IdClient'], $addressesData);
            }
        }

        echo json_encode($updatedData);
    }


    public function deleteClient() {
        $data = $_POST;
        $adminModel = new Admin();
        $result = $adminModel->deleteClient($data['id']);
        echo json_encode($result);
    }

    private function convertToAssociativeArrayClient($dataArray) {
        $data = [];
        foreach ($dataArray as $item) {
            $key = str_replace('client[', '', rtrim($item['name'], ']'));
            $data[$key] = $item['value'];
        }
        return $data;
    }

    private function convertToAssociativeArrayAddresses($dataArray) {
        $addresses = [];
        
        foreach ($dataArray as $item) {
            $key = str_replace('addresses[', '', rtrim($item['name'], ']'));
            $addresses[$key] = $item['value'];
        }
        
        return $addresses;
    }
}
