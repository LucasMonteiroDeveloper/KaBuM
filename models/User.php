<?php

class User extends Model 
{
    // Método para verificar as credenciais do usuário
    public function checkUser($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch();
            // Verifica se a senha está correta
            if (password_verify($password, $user['Password'])) {
                return $user; // Retorna os dados do usuário
            }
        }

        return false; // Retorna falso se o usuário não for encontrado ou a senha estiver incorreta
    }

    // Método para registrar um novo usuário
    public function registerUser($email, $username, $password)
    {
        $sql = "INSERT INTO users (email, username, password) VALUES (:email, :username, :password)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT)); // Hash da senha
        $stmt->execute();

        return $this->db->lastInsertId(); // Retorna o ID do novo usuário
    }

    // Método para verificar se o email já está registrado
    public function isEmailAvailable($email)
    {
        $sql = "SELECT COUNT(*) FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        return $stmt->fetchColumn() == 0;
    }

    // Método para obter o ID do usuário pelo email
    public function getIdByEmail($email)
    {
        $sql = "SELECT IdUser FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
}
