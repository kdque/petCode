<?php
// src/model/Usuario.php

include_once $_SERVER['DOCUMENT_ROOT'] . '/petCode/src/config/Database.php';

class Usuario {
    private $conn;

    // Atributos do usuário
    public $id_usuario;
    public $username;
    public $senha;
    public $nivel_acesso;

    // Construtor que recebe a conexão do banco de dados
    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para verificar o login do usuário
    public function login() {
        // Consulta SQL para buscar o usuário pelo nome de usuário
        $query = "SELECT id_usuario, username, senha, nivel_acesso FROM usuarios WHERE username = :username LIMIT 0,1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $this->username);
        $stmt->execute();

        // Verificar se o usuário existe
        if ($stmt->rowCount() > 0) {
            // Recuperar os dados do usuário
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verificar se a senha está correta
            if (password_verify($this->senha, $row['senha'])) {
                // Definir os atributos da classe com os dados do usuário
                $this->id_usuario = $row['id_usuario'];
                $this->nivel_acesso = $row['nivel_acesso'];

                return true;
            }
        }

        return false;
    }

    // Método para criar um novo usuário
    public function create() {
        // Consulta SQL para inserir um novo usuário
        $query = "INSERT INTO usuarios (username, senha, nivel_acesso) VALUES (:username, :senha, :nivel_acesso)";

        $stmt = $this->conn->prepare($query);

        // Hash da senha para segurança
        $hashed_password = password_hash($this->senha, PASSWORD_BCRYPT);

        // Vincular os parâmetros ao método prepare
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':senha', $hashed_password);
        $stmt->bindParam(':nivel_acesso', $this->nivel_acesso);

        // Executar a consulta e verificar sucesso
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Método para atualizar os dados de um usuário
    public function update() {
        // Consulta SQL para atualizar dados do usuário
        $query = "UPDATE usuarios SET username = :username, senha = :senha, nivel_acesso = :nivel_acesso WHERE id_usuario = :id_usuario";

        $stmt = $this->conn->prepare($query);

        // Hash da senha para segurança
        $hashed_password = password_hash($this->senha, PASSWORD_BCRYPT);

        // Vincular os parâmetros ao método prepare
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':senha', $hashed_password);
        $stmt->bindParam(':nivel_acesso', $this->nivel_acesso);
        $stmt->bindParam(':id_usuario', $this->id_usuario);

        // Executar a consulta e verificar sucesso
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Método para excluir um usuário
    public function delete() {
        // Consulta SQL para deletar um usuário
        $query = "DELETE FROM usuarios WHERE id_usuario = :id_usuario";

        $stmt = $this->conn->prepare($query);

        // Vincular o parâmetro ao método prepare
        $stmt->bindParam(':id_usuario', $this->id_usuario);

        // Executar a consulta e verificar sucesso
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
