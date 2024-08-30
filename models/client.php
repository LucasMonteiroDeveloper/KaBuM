<?php
require_once BASE_URL.'core/Model.php';
header('Content-Type: application/json');
class Client extends Model {

    public function getAllClients() {
        $stmt = $this->db->prepare("SELECT * FROM clients");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addClient($data) {
        $stmt = $this->db->prepare("INSERT INTO clients (name, date_of_birth, cpf, rg, phone) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$data['name'], $data['date_of_birth'], $data['cpf'], $data['rg'], $data['phone']]);
        return $this->db->lastInsertId();
    }

    public function updateClient($data) {
        $stmt = $this->db->prepare("UPDATE clients SET name = ?, date_of_birth = ?, cpf = ?, rg = ?, phone = ? WHERE id = ?");
        $stmt->execute([$data['name'], $data['date_of_birth'], $data['cpf'], $data['rg'], $data['phone'], $data['id']]);
    }

    public function deleteClient($id) {
        $stmt = $this->db->prepare("DELETE FROM clients WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function getClientById($id) {
        $stmt = $this->db->prepare("SELECT * FROM clients WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}