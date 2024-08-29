<?php

class adminController extends controller
{
    public function index() {
        $dados = array();

        $this->loadTemplate('admin', $dados);
    }
}