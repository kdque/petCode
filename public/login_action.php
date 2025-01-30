<?php
session_start();

// Incluir os arquivos necessários com o caminho correto
include_once '../src/model/Usuario.php';
include_once '../src/config/Database.php';  // Corrigido o caminho

// Verificar se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Criar a conexão com o banco de dados
    $database = new Database();
    $db = $database->getConnection();

    // Criar o objeto Usuário
    $usuario = new Usuario($db);

    // Receber os dados do formulário
    $usuario->username = $_POST['username'];
    $usuario->senha = $_POST['senha'];

    // Verificar se o login é válido
    if ($usuario->login()) {
        $_SESSION['usuario_id'] = dump($usuario)->id_usuario; // Armazenar o ID do usuário na sessão
        header('Location: dashboard.php'); // Redirecionar para o dashboard
    } else {
        echo "Usuário ou senha inválidos!";
    }
}
?>
