<?php

class registerController extends controller
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
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

            $userModel = new User();

            if ($userModel->isEmailAvailable($email)) {
                $userModel->registerUser($email, $username, $password);
                header("Location: " . BASE_URL . "login");
                exit;
            } else {
                $error = 'Este e-mail já está registrado.';
            }
        }

        $data['error'] = $error;
        $this->loadView('register', $data);
    }
}
