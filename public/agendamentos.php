<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php'); // Redireciona para o login se não estiver logado
    exit;
}

include_once '../src/model/Agendamento.php';
include_once '../config/Database.php';

// Criar a conexão com o banco de dados
$database = new Database();
$db = $database->getConnection();

// Criar o objeto Agendamento
$agendamento = new Agendamento($db);

// Obter todos os agendamentos
$stmt = $agendamento->read();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Agendamentos</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="dashboard-container">
        <h2>Gerenciar Agendamentos</h2>

        <!-- Tabela de Agendamentos -->
        <table border="1" width="100%">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Motivo</th>
                    <th>Cliente</th>
                    <th>Animal</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo $row['data']; ?></td>
                        <td><?php echo $row['hora']; ?></td>
                        <td><?php echo $row['motivo']; ?></td>
                        <td><?php echo $row['id_cliente']; ?></td>
                        <td><?php echo $row['id_animal']; ?></td>
                        <td>
                            <a href="editar_agendamento.php?id=<?php echo $row['id_agendamento']; ?>">Editar</a>
                            <a href="excluir_agendamento.php?id=<?php echo $row['id_agendamento']; ?>">Excluir</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <br><br>
        <a href="adicionar_agendamento.php">Adicionar Novo Agendamento</a>
    </div>
</body>
</html>
