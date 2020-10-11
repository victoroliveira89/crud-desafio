<?php

namespace App\Controllers;

use CRUD\Controller\Action;
use CRUD\Model\Container;


class IndexController extends Action {

    public function index() {
        $this->render('index', 'layout1');
    }

    public function cadastrar() {
        $this->view->erroCadastro = false;
        $this->view->user = array (
            'nome' => '',
            'email' => '',
            'cidade' => '',
            'estado' => '',
            'cep' => '',
        );
        $this->render('cadastrar', 'layout1');
    }

    public function registrar() {
        
        $usuario = Container::getModel('User');
        $usuario->__set('nome', $_POST['nome']);
        $usuario->__set('email', $_POST['email']);
        $usuario->__set('cidade', $_POST['cidade']);
        $usuario->__set('estado', $_POST['estado']);
        $usuario->__set('cep', $_POST['cep']);

        for ($i = 5; $i < count($_POST); $i++) {
            $j++;
            $usuario->setTel($j, $_POST['fone' . $j]);
        }
        
        if ($usuario->validarRegistro() && count($usuario->getUserValid()) == 0) {
                $usuario->salvar();
                $this->render('registrar', 'layout1');
        } else {
            $this->view->user = array (
                'nome' => $_POST['nome'],
                'email' => $_POST['email'],
                'cidade' => $_POST['cidade'],
                'estado' => $_POST['estado'],
                'cep' => $_POST['cep'],
            );
            $this->view->erroCadastro = true;
            $this->render('cadastrar', 'layout1');
        }
        
    }

    public function busca() {
        $this->render('busca', 'layout1');
    }

    public function consulta() {
        $usuario = Container::getModel('User');
        $this->view->user = $usuario->getUser($_POST['email']);
        $this->view->tel = $usuario->getTel($this->view->user[0]['id_usuario']);

        $this->render('consulta', 'layout1');
    }
}