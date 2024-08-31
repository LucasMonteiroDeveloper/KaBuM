<?php

class Admin extends Model 
{
    public function getClients($searchQuery = '') 
    {
        $sql = ("
            SELECT 
                c.IdClient, 
                c.Name, 
                c.Date_Birth, 
                c.CPF, 
                c.RG, 
                c.Telephone,
                IFNULL(a.Street, '') AS Street,
                COUNT(a.IdAddress) AS address_count
            FROM clients c
            LEFT JOIN Address a ON c.IdClient = a.IdClient
            WHERE c.Name LIKE :searchQuery OR c.CPF LIKE :searchQuery
            GROUP BY c.IdClient
        ");
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['searchQuery' => "%$searchQuery%"]);
        $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $clients;
    }

    public function getClientsById($idClient) 
    {
        $stmt = $this->db->prepare("SELECT * FROM clients WHERE IdClient = ?");    
        $stmt->execute([$idClient]);
        $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $clients;
    }

    public function getAddressesByClientId($idClient) 
    {
        $stmt = $this->db->prepare("SELECT * FROM Address WHERE IdClient = ?");
        $stmt->execute([$idClient]);
        $addresses = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $addresses;
    }

    public function addClient($data) 
    {
        $stmt = $this->db->prepare("INSERT INTO clients (name, Date_Birth, CPF, RG, Telephone) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$data['Name'], $data['Date_Birth'], $data['CPF'], $data['RG'], $data['Telephone']]);
        return $this->db->lastInsertId();
    }

    public function updateClient($data) 
    {
        $stmt = $this->db->prepare("UPDATE clients SET name = ?, Date_Birth = ?, CPF = ?, RG = ?, Telephone = ? WHERE IdClient = ?");
        $stmt->execute([$data['Name'], $data['Date_Birth'], $data['CPF'], $data['RG'], $data['Telephone'], $data['IdClient']]);
        return $data;
    }

    public function addAddress($idClient, $address) 
    {
        $stmt = $this->db->prepare("INSERT INTO Address (IdClient, Street, Number, City, State, CEP) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$idClient, $address['Street'], $address['Number'], $address['City'], $address['State'], $address['CEP']]);
    }

    public function deleteAddresses($idClient) 
    {
        $stmt = $this->db->prepare("DELETE FROM Address WHERE IdClient = ?");
        $stmt->execute([$idClient]);
    }

    public function deleteClient($idClient) 
    {
        try {
            $this->db->beginTransaction();
    
            $this->deleteAddresses($idClient);
    
            $stmt = $this->db->prepare("DELETE FROM clients WHERE IdClient = ?");
            $stmt->execute([$idClient]);
    
            $this->db->commit();
            return ['success' => true];
        } catch (Exception $e) {
            $this->db->rollBack();
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function deleteAddress($idAddress) 
    {
        $stmt = $this->db->prepare("DELETE FROM Address WHERE IdAddress = ?");
        $stmt->execute([$idAddress]);
        return ['success' => $stmt->rowCount() > 0];
    }
}
