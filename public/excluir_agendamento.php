<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php'); // Redireciona para o login se não estiver logado
    exit;
}

include_once '../src/model/Agendamento.php';
include_once '../config/Database.php';

if (isset($_GET['id'])) {
    // Criar a conexão com o banco de dados
    $database = new Database();
    $db = $database->getConnection();

    // Criar o objeto Agendamento
    $agendamento = new Agendamento($db);
    
    // Definir o ID do agendamento
    $agendamento->id_agendamento = $_GET['id'];

    // Tentar excluir o agendamento
    if ($agendamento->delete()) {
        header("Location: agendamentos.php"); // Redireciona para a lista de agendamentos
    } else {
        echo "Erro ao excluir o agendamento!";
    }
}
?>
