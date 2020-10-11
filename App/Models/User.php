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
    private $telefones = [];

    public function __get($atributo) {
        return $this->$atributo;
    }
    
    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
    }

    public function setTel($indice, $valor) {
        $this->telefones[$indice] = $valor;
    }

    public function salvar() {
        $query = "INSERT INTO usuarios(nome, email, cidade, estado, cep) VALUES (:nome, :email, :cidade, :estado, :cep)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':nome', $this->__get('nome'));
        $stmt->bindValue(':email', $this->__get('email'));
        $stmt->bindValue(':cidade', $this->__get('cidade'));
        $stmt->bindValue(':estado', $this->__get('estado'));
        $stmt->bindValue(':cep', $this->__get('cep'));
        $stmt->execute();

        $query = "SELECT id_usuario FROM usuarios WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':email', $this->__get('email'));
        $stmt->execute();
        $aux = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $id = $aux[0]['id_usuario'];

        for ($i = 0; $i <= count($this->telefones); $i++){
            $query = "INSERT INTO telefones(num_tel, id_usuario) VALUES (:telefone, :id)";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':telefone', $this->telefones[$i]);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
        }
        return $this;
    }

    public function salvarTelefone() {
        $query = "SELECT id_usuario FROM usuarios WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':email', $this->__get('email'));
        $stmt->execute();
        $aux = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $id = $aux[0]['id_usuario'];

        return $id;
    }

    public function validarRegistro() {
        $valido = true;

        return $valido;
    }

    public function getUserValid() {
        $query = "SELECT nome, email FROM usuarios WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':email', $this->__get('email'));
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getUser($email) {
        $query = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getTel($id) {
        echo $id;

        $query = "SELECT * FROM telefones WHERE id_usuario = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}