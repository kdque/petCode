<?php
// src/model/Agendamento.php

include_once 'config/Database.php';

class Agendamento {
    private $conn;

    // Atributos do agendamento
    public $id_agendamento;
    public $data;
    public $hora;
    public $motivo;
    public $id_cliente;
    public $id_animal;

    // Construtor que recebe a conexão do banco de dados
    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para criar um novo agendamento
    public function create() {
        // Consulta SQL para inserir um novo agendamento
        $query = "INSERT INTO agendamentos (data, hora, motivo, id_cliente, id_animal) 
                  VALUES (:data, :hora, :motivo, :id_cliente, :id_animal)";

        $stmt = $this->conn->prepare($query);

        // Vincular os parâmetros ao método prepare
        $stmt->bindParam(':data', $this->data);
        $stmt->bindParam(':hora', $this->hora);
        $stmt->bindParam(':motivo', $this->motivo);
        $stmt->bindParam(':id_cliente', $this->id_cliente);
        $stmt->bindParam(':id_animal', $this->id_animal);

        // Executar a consulta e verificar sucesso
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Método para ler todos os agendamentos
    public function read() {
        // Consulta SQL para buscar todos os agendamentos
        $query = "SELECT * FROM agendamentos";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Método para buscar um agendamento pelo ID
    public function readOne() {
        // Consulta SQL para buscar um agendamento pelo ID
        $query = "SELECT * FROM agendamentos WHERE id_agendamento = :id_agendamento LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_agendamento', $this->id_agendamento);
        $stmt->execute();

        // Verificar se o agendamento existe e retornar os dados
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->data = $row['data'];
            $this->hora = $row['hora'];
            $this->motivo = $row['motivo'];
            $this->id_cliente = $row['id_cliente'];
            $this->id_animal = $row['id_animal'];

            return true;
        }

        return false;
    }

    // Método para atualizar os dados de um agendamento
    public function update() {
        // Consulta SQL para atualizar dados do agendamento
        $query = "UPDATE agendamentos SET data = :data, hora = :hora, motivo = :motivo, 
                  id_cliente = :id_cliente, id_animal = :id_animal WHERE id_agendamento = :id_agendamento";

        $stmt = $this->conn->prepare($query);

        // Vincular os parâmetros ao método prepare
        $stmt->bindParam(':data', $this->data);
        $stmt->bindParam(':hora', $this->hora);
        $stmt->bindParam(':motivo', $this->motivo);
        $stmt->bindParam(':id_cliente', $this->id_cliente);
        $stmt->bindParam(':id_animal', $this->id_animal);
        $stmt->bindParam(':id_agendamento', $this->id_agendamento);

        // Executar a consulta e verificar sucesso
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Método para excluir um agendamento
    public function delete() {
        // Consulta SQL para deletar um agendamento
        $query = "DELETE FROM agendamentos WHERE id_agendamento = :id_agendamento";

        $stmt = $this->conn->prepare($query);

        // Vincular o parâmetro ao método prepare
        $stmt->bindParam(':id_agendamento', $this->id_agendamento);

        // Executar a consulta e verificar sucesso
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
