<?php
session_start();
if (isset($_SESSION['usuario_id'])) {
    // Se já estiver logado, redireciona para o dashboard
    header('Location: dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="login_action.php" method="POST">
            <label for="username">Usuário:</label>
            <input type="text" name="username" id="username" required><br><br>

            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" required><br><br>

            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>
