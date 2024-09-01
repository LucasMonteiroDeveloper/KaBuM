<?php
require __DIR__ . '/../config.php';
require_once __DIR__ . '/../core/Model.php';
require_once __DIR__ . '/../models/Admin.php';
require_once __DIR__ . '/../models/User.php';

function testAddClient() {
    $admin = new Admin();
    $data = [
        'Name' => 'John Doe',
        'Date_Birth' => '1990-01-01',
        'CPF' => '111.222.333-00',
        'RG' => '55.555.555-5',
        'Telephone' => '(11) 11234-5678)'
    ];

    $clientId = $admin->addClient($data);
    assert(!empty($clientId), 'Falha ao adicionar cliente.');
}

function testGetClients() {
    $admin = new Admin();
    $clients = $admin->getClients();
    assert(is_array($clients), 'Falha ao buscar clientes.');
    assert(count($clients) > 0, 'Nenhum cliente encontrado.');
}