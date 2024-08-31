<?php

class controller 
{
    public function checkLogin() {
        if (!isset($_SESSION['user_id'])) {
            $login = new loginController();
            $login->index();
            exit;
        }
    }
    
    public function loadView($viewName) {
        require 'views/'.$viewName.'.php';
    }

    public function loadTemplate($viewName, $viewData = array()) {
        require 'views/template.php';
    }

    public function loadViewInTemplate($viewName, $viewData = array()) {
        extract($viewData);
        require 'views/'.$viewName.'.php';
    }
}