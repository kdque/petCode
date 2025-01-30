<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php'); // Redireciona para o login se não estiver logado
    exit;
}

include_once '../src/model/Cliente.php';
include_once '../config/Database.php';

// Criar a conexão com o banco de dados
$database = new Database();
$db = $database->getConnection();

// Criar o objeto Cliente
$cliente = new Cliente($db);

// Obter todos os clientes
$stmt = $cliente->read();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Clientes</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="dashboard-container">
        <h2>Gerenciar Clientes</h2>

        <!-- Tabela de Clientes -->
        <table border="1" width="100%">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Endereço</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo $row['nome']; ?></td>
                        <td><?php echo $row['cpf']; ?></td>
                        <td><?php echo $row['endereco']; ?></td>
                        <td><?php echo $row['telefone']; ?></td>
                        <td>
                            <a href="editar_cliente.php?id=<?php echo $row['id_cliente']; ?>">Editar</a>
                            <a href="excluir_cliente.php?id=<?php echo $row['id_cliente']; ?>">Excluir</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <br><br>
        <a href="adicionar_cliente.php">Adicionar Novo Cliente</a>
    </div>
</body>
</html>
