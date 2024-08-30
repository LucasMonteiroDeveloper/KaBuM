<?php

class Admin extends Model 
{
    public function getClients() {
        $stmt = $this->db->prepare("SELECT * FROM clients");
        $stmt->execute();
        $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $clients;
    }

    public function addClient($data) {
        $stmt = $this->db->prepare("INSERT INTO clients (name, date_of_birth, cpf, rg, phone) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$data['name'], $data['dateOfBirth'], $data['cpf'], $data['rg'], $data['phone']]);
        return $this->db->lastInsertId();
    }

    public function updateClient($data) {
        $stmt = $this->db->prepare("UPDATE clients SET name = ?, date_of_birth = ?, cpf = ?, rg = ?, phone = ? WHERE id = ?");
        $stmt->execute([$data['name'], $data['dateOfBirth'], $data['cpf'], $data['rg'], $data['phone'], $data['id']]);
        return $data;
    }

    public function deleteClient($id) {
        $stmt = $this->db->prepare("DELETE FROM clients WHERE id = ?");
        $stmt->execute([$id]);
        return ['success' => true];
    }
}
