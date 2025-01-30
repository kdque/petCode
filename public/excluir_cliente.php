<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php'); // Redireciona para o login se não estiver logado
    exit;
}

include_once '../src/model/Cliente.php';
include_once '../config/Database.php';

if (isset($_GET['id'])) {
    // Criar a conexão com o banco de dados
    $database = new Database();
    $db = $database->getConnection();

    // Criar o objeto Cliente
    $cliente = new Cliente($db);
    
    // Definir o ID do cliente
    $cliente->id_cliente = $_GET['id'];

    // Tentar excluir o cliente
    if ($cliente->delete()) {
        header("Location: clientes.php"); // Redireciona para a lista de clientes
    } else {
        echo "Erro ao excluir o cliente!";
    }
}
?>
