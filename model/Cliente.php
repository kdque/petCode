<?php
// src/model/Cliente.php

include_once 'config/Database.php';

class Cliente {
    private $conn;

    // Atributos do cliente
    public $id_cliente;
    public $nome;
    public $cpf;
    public $endereco;
    public $telefone;

    // Construtor que recebe a conexão do banco de dados
    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para criar um novo cliente
    public function create() {
        // Consulta SQL para inserir um novo cliente
        $query = "INSERT INTO clientes (nome, cpf, endereco, telefone) VALUES (:nome, :cpf, :endereco, :telefone)";

        $stmt = $this->conn->prepare($query);

        // Vincular os parâmetros ao método prepare
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':cpf', $this->cpf);
        $stmt->bindParam(':endereco', $this->endereco);
        $stmt->bindParam(':telefone', $this->telefone);

        // Executar a consulta e verificar sucesso
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Método para ler todos os clientes
    public function read() {
        // Consulta SQL para buscar todos os clientes
        $query = "SELECT * FROM clientes";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Método para buscar um cliente pelo ID
    public function readOne() {
        // Consulta SQL para buscar um cliente pelo ID
        $query = "SELECT * FROM clientes WHERE id_cliente = :id_cliente LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_cliente', $this->id_cliente);
        $stmt->execute();

        // Verificar se o cliente existe e retornar os dados
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->nome = $row['nome'];
            $this->cpf = $row['cpf'];
            $this->endereco = $row['endereco'];
            $this->telefone = $row['telefone'];

            return true;
        }

        return false;
    }

    // Método para atualizar os dados de um cliente
    public function update() {
        // Consulta SQL para atualizar dados do cliente
        $query = "UPDATE clientes SET nome = :nome, cpf = :cpf, endereco = :endereco, telefone = :telefone WHERE id_cliente = :id_cliente";

        $stmt = $this->conn->prepare($query);

        // Vincular os parâmetros ao método prepare
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':cpf', $this->cpf);
        $stmt->bindParam(':endereco', $this->endereco);
        $stmt->bindParam(':telefone', $this->telefone);
        $stmt->bindParam(':id_cliente', $this->id_cliente);

        // Executar a consulta e verificar sucesso
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Método para excluir um cliente
    public function delete() {
        // Consulta SQL para deletar um cliente
        $query = "DELETE FROM clientes WHERE id_cliente = :id_cliente";

        $stmt = $this->conn->prepare($query);

        // Vincular o parâmetro ao método prepare
        $stmt->bindParam(':id_cliente', $this->id_cliente);

        // Executar a consulta e verificar sucesso
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
