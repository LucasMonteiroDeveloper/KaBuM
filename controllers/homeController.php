<?php

class homeController extends controller
{
    public function __construct() 
    {
        $this->checkLogin();
    }
    
    public function index() {
        $dados = array();

        $this->loadTemplate('home', $dados);
    }
}