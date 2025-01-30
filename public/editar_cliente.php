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

    // Obter os dados do cliente
    if ($cliente->readOne()) {
        // Exibir os dados do cliente no formulário
        $nome = $cliente->nome;
        $cpf = $cliente->cpf;
        $endereco = $cliente->endereco;
        $telefone = $cliente->telefone;
    } else {
        echo "Cliente não encontrado.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Atualizar os dados do cliente
    $cliente->nome = $_POST['nome'];
    $cliente->cpf = $_POST['cpf'];
    $cliente->endereco = $_POST['endereco'];
    $cliente->telefone = $_POST['telefone'];

    if ($cliente->update()) {
        header("Location: clientes.php"); // Redireciona para a lista de clientes
    } else {
        echo "Erro ao atualizar o cliente!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="dashboard-container">
        <h2>Editar Cliente</h2>
        <form action="editar_cliente.php?id=<?php echo $cliente->id_cliente; ?>" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" value="<?php echo $nome; ?>" required><br><br>

            <label for="cpf">CPF:</label>
            <input type="text" name="cpf" id="cpf" value="<?php echo $cpf; ?>" required><br><br>

            <label for="endereco">Endereço:</label>
            <input type="text" name="endereco" id="endereco" value="<?php echo $endereco; ?>" required><br><br>

            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone" id="telefone" value="<?php echo $telefone; ?>" required><br><br>

            <button type="submit">Atualizar Cliente</button>
        </form>
    </div>
</body>
</html>
