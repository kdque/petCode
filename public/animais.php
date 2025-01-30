<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php'); // Redireciona para o login se não estiver logado
    exit;
}

include_once '../src/model/Animal.php';
include_once '../config/Database.php';

// Criar a conexão com o banco de dados
$database = new Database();
$db = $database->getConnection();

// Criar o objeto Animal
$animal = new Animal($db);

// Obter todos os animais
$stmt = $animal->read();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Animais</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="dashboard-container">
        <h2>Gerenciar Animais</h2>

        <!-- Tabela de Animais -->
        <table border="1" width="100%">
            <thead>
                <tr>
                    <th>Nome do Animal</th>
                    <th>Espécie</th>
                    <th>Raça</th>
                    <th>Idade</th>
                    <th>Cliente</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo $row['nome_animal']; ?></td>
                        <td><?php echo $row['especie']; ?></td>
                        <td><?php echo $row['raca']; ?></td>
                        <td><?php echo $row['idade']; ?></td>
                        <td><?php echo $row['id_cliente']; ?></td>
                        <td>
                            <a href="editar_animal.php?id=<?php echo $row['id_animal']; ?>">Editar</a>
                            <a href="excluir_animal.php?id=<?php echo $row['id_animal']; ?>">Excluir</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <br><br>
        <a href="adicionar_animal.php">Adicionar Novo Animal</a>
    </div>
</body>
</html>
