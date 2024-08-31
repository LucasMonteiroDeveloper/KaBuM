<?php

class loginController extends controller
{
    public function index()
    {
        // Verifica se o usuário já está logado
        if (isset($_SESSION['user_id'])) {
            header("Location: " . BASE_URL);
            exit;
        }

        $data = array();
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

            $userModel = new User();

            if ($userModel->checkUser($email, $password)) {
                $_SESSION['user_id'] = $userModel->getIdByEmail($email); // Inicia a sessão com o ID do usuário
                header("Location: " . BASE_URL);
                exit;
            } else {
                $error = 'Email ou senha inválidos.';
            }
        }

        $data['error'] = $error;
        $this->loadView('login', $data);
    }
}
