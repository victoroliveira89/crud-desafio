<?php

namespace App\Models;

use CRUD\Model\Model;

class User extends Model {
    private $id;
    private $nome;
    private $email;
    private $cidade;
    private $estado;
    private $cep;

    public function __get($atributo) {
        return $this->$atributo;
    }
    
    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
    }

    public function salvar() {
        $query = "INSERT INTO usuarios($nome, $email, $cidade, $estado, $cep)VALUES(:nome, :email, :cidade, :estado, :cep)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':nome', $this->__get('nome'));
        $stmt->bindValue(':email', $this->__get('email'));
        $stmt->bindValue(':cidade', $this->__get('cidade'));
        $stmt->bindValue(':estado', $this->__get('estado'));
        $stmt->bindValue(':cep', $this->__get('cep'));
        $stmt->execute();

        return $this;
    }

    public function getUser() {
        $query = "SELECT id, nome, email, cidade, estado, cep FROM usuarios";
        return $this->db->query($query)->fetchAll();
    }
}