<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php'); // Redireciona para o login se não estiver logado
    exit;
}

include_once '../src/model/Animal.php';
include_once '../config/Database.php';

$nome_animal = $especie = $raca = $idade = $id_cliente = "";
$nome_animal_err = $especie_err = $raca_err = $idade_err = $id_cliente_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Criar a conexão com o banco de dados
    $database = new Database();
    $db = $database->getConnection();

    // Criar o objeto Animal
    $animal = new Animal($db);

    // Receber os dados do formulário
    $animal->nome_animal = $_POST['nome_animal'];
    $animal->especie = $_POST['especie'];
    $animal->raca = $_POST['raca'];
    $animal->idade = $_POST['idade'];
    $animal->id_cliente = $_POST['id_cliente'];

    // Tentar adicionar o animal ao banco de dados
    if ($animal->create()) {
        header("Location: animais.php");
    } else {
        echo "Erro ao adicionar o animal!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Animal</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="dashboard-container">
        <h2>Adicionar Novo Animal</h2>
        <form action="adicionar_animal.php" method="POST">
            <label for="nome_animal">Nome do Animal:</label>
            <input type="text" name="nome_animal" id="nome_animal" required><br><br>

            <label for="especie">Espécie:</label>
            <input type="text" name="especie" id="especie" required><br><br>

            <label for="raca">Raça:</label>
            <input type="text" name="raca" id="raca" required><br><br>

            <label for="idade">Idade:</label>
            <input type="number" name="idade" id="idade" required><br><br>

            <label for="id_cliente">ID do Cliente:</label>
            <input type="number" name="id_cliente" id="id_cliente" required><br><br>

            <button type="submit">Adicionar Animal</button>
        </form>
    </div>
</body>
</html>
