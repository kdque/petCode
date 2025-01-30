<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php'); // Redireciona para o login se não estiver logado
    exit;
}

include_once '../src/model/Cliente.php';
include_once '../config/Database.php';

$nome = $cpf = $endereco = $telefone = "";
$nome_err = $cpf_err = $endereco_err = $telefone_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Criar a conexão com o banco de dados
    $database = new Database();
    $db = $database->getConnection();

    // Criar o objeto Cliente
    $cliente = new Cliente($db);

    // Receber os dados do formulário
    $cliente->nome = $_POST['nome'];
    $cliente->cpf = $_POST['cpf'];
    $cliente->endereco = $_POST['endereco'];
    $cliente->telefone = $_POST['telefone'];

    // Tentar adicionar o cliente ao banco de dados
    if ($cliente->create()) {
        header("Location: clientes.php");
    } else {
        echo "Erro ao adicionar o cliente!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Cliente</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="dashboard-container">
        <h2>Adicionar Novo Cliente</h2>
        <form action="adicionar_cliente.php" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" required><br><br>

            <label for="cpf">CPF:</label>
            <input type="text" name="cpf" id="cpf" required><br><br>

            <label for="endereco">Endereço:</label>
            <input type="text" name="endereco" id="endereco" required><br><br>

            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone" id="telefone" required><br><br>

            <button type="submit">Adicionar Cliente</button>
        </form>
    </div>
</body>
</html>
