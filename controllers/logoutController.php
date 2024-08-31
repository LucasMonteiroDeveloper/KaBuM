<?php

class logoutController extends controller
{
    public function index()
    {
        // Destroi a sessão do usuário
        session_start();
        session_destroy();

        // Redireciona para a página de login
        $login = new loginController();
        $login->index();
        exit;
    }
}