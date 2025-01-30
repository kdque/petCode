<?php
// src/model/Animal.php

include_once 'config/Database.php';

class Animal {
    private $conn;

    // Atributos do animal
    public $id_animal;
    public $nome_animal;
    public $especie;
    public $raca;
    public $idade;
    public $id_cliente;  // Relacionado com a tabela de clientes

    // Construtor que recebe a conexão do banco de dados
    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para criar um novo animal
    public function create() {
        // Consulta SQL para inserir um novo animal
        $query = "INSERT INTO animais (nome_animal, especie, raca, idade, id_cliente) 
                  VALUES (:nome_animal, :especie, :raca, :idade, :id_cliente)";

        $stmt = $this->conn->prepare($query);

        // Vincular os parâmetros ao método prepare
        $stmt->bindParam(':nome_animal', $this->nome_animal);
        $stmt->bindParam(':especie', $this->especie);
        $stmt->bindParam(':raca', $this->raca);
        $stmt->bindParam(':idade', $this->idade);
        $stmt->bindParam(':id_cliente', $this->id_cliente);

        // Executar a consulta e verificar sucesso
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Método para ler todos os animais
    public function read() {
        // Consulta SQL para buscar todos os animais
        $query = "SELECT * FROM animais";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Método para buscar um animal pelo ID
    public function readOne() {
        // Consulta SQL para buscar um animal pelo ID
        $query = "SELECT * FROM animais WHERE id_animal = :id_animal LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_animal', $this->id_animal);
        $stmt->execute();

        // Verificar se o animal existe e retornar os dados
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->nome_animal = $row['nome_animal'];
            $this->especie = $row['especie'];
            $this->raca = $row['raca'];
            $this->idade = $row['idade'];
            $this->id_cliente = $row['id_cliente'];

            return true;
        }

        return false;
    }

    // Método para atualizar os dados de um animal
    public function update() {
        // Consulta SQL para atualizar dados do animal
        $query = "UPDATE animais SET nome_animal = :nome_animal, especie = :especie, raca = :raca, idade = :idade, id_cliente = :id_cliente WHERE id_animal = :id_animal";

        $stmt = $this->conn->prepare($query);

        // Vincular os parâmetros ao método prepare
        $stmt->bindParam(':nome_animal', $this->nome_animal);
        $stmt->bindParam(':especie', $this->especie);
        $stmt->bindParam(':raca', $this->raca);
        $stmt->bindParam(':idade', $this->idade);
        $stmt->bindParam(':id_cliente', $this->id_cliente);
        $stmt->bindParam(':id_animal', $this->id_animal);

        // Executar a consulta e verificar sucesso
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Método para excluir um animal
    public function delete() {
        // Consulta SQL para deletar um animal
        $query = "DELETE FROM animais WHERE id_animal = :id_animal";

        $stmt = $this->conn->prepare($query);

        // Vincular o parâmetro ao método prepare
        $stmt->bindParam(':id_animal', $this->id_animal);

        // Executar a consulta e verificar sucesso
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
