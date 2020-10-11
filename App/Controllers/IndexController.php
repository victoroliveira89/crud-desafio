<?php

namespace App\Controllers;

use CRUD\Controller\Action;
use CRUD\Model\Container;


class IndexController extends Action {

    public function index() {
        $this->render('index', 'layout1');
    }

    public function cadastrar() {
        $this->render('cadastrar', 'layout1');
    }

    public function registrar() {
        $usuario = Container::getModel('User');
        $usuario->__set('nome', $_POST['nome']);
        $usuario->__set('email', $_POST['email']);
        $usuario->__set('cidade', $_POST['cidade']);
        $usuario->__set('estado', $_POST['estado']);
        $usuario->__set('cep', $_POST['cep']);

        $usuario->salvar();
    }
}