<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php'); // Redireciona para o login se não estiver logado
    exit;
}

// Se o usuário estiver logado, mostrar o dashboard
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="dashboard-container">
        <h2>Bem-vindo ao Sistema Veterinário</h2>
        <p>Você está logado como <strong><?php echo $_SESSION['usuario_id']; ?></strong></p>

        <div class="links">
            <a href="clientes.php">Gerenciar Clientes</a><br>
            <a href="animais.php">Gerenciar Animais</a><br>
            <a href="agendamentos.php">Gerenciar Agendamentos</a><br>
            <a href="logout.php">Sair</a>
        </div>
    </div>
</body>
</html>
