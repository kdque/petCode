<?php
// config/Database.php

class Database {
    private $host = 'localhost';
    private $db_name = 'clinica_veterinaria'; // Nome do banco de dados
    private $username = 'root'; // Usuário do MySQL
    private $password = ''; // Senha do MySQL
    public $conn;

    // Método para conectar ao banco de dados
    public function getConnection() {
        $this->conn = null;

        try {
            // Conectando ao banco de dados utilizando PDO
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Erro ao conectar com o banco de dados: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
