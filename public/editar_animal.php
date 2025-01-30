<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php'); // Redireciona para o login se não estiver logado
    exit;
}

include_once '../src/model/Animal.php';
include_once '../config/Database.php';

if (isset($_GET['id'])) {
    // Criar a conexão com o banco de dados
    $database = new Database();
    $db = $database->getConnection();

    // Criar o objeto Animal
    $animal = new Animal($db);
    
    // Definir o ID do animal
    $animal->id_animal = $_GET['id'];

    // Obter os dados do animal
    if ($animal->readOne()) {
        // Exibir os dados do animal no formulário
        $nome_animal = $animal->nome_animal;
        $especie = $animal->especie;
        $raca = $animal->raca;
        $idade = $animal->idade;
        $id_cliente = $animal->id_cliente;
    } else {
        echo "Animal não encontrado.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Atualizar os dados do animal
    $animal->nome_animal = $_POST['nome_animal'];
    $animal->especie = $_POST['especie'];
    $animal->raca = $_POST['raca'];
    $animal->idade = $_POST['idade'];
    $animal->id_cliente = $_POST['id_cliente'];

    if ($animal->update()) {
        header("Location: animais.php"); // Redireciona para a lista de animais
    } else {
        echo "Erro ao atualizar o animal!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Animal</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="dashboard-container">
        <h2>Editar Animal</h2>
        <form action="editar_animal.php?id=<?php echo $animal->id_animal; ?>" method="POST">
            <label for="nome_animal">Nome do Animal:</label>
            <input type="text" name="nome_animal" id="nome_animal" value="<?php echo $nome_animal; ?>" required><br><br>

            <label for="especie">Espécie:</label>
            <input type="text" name="especie" id="especie" value="<?php echo $especie; ?>" required><br><br>

            <label for="raca">Raça:</label>
            <input type="text" name="raca" id="raca" value="<?php echo $raca; ?>" required><br><br>

            <label for="idade">Idade:</label>
            <input type="number" name="idade" id="idade" value="<?php echo $idade; ?>" required><br><br>

            <label for="id_cliente">ID do Cliente:</label>
            <input type="number" name="id_cliente" id="id_cliente" value="<?php echo $id_cliente; ?>" required><br><br>

            <button type="submit">Atualizar Animal</button>
        </form>
    </div>
</body>
</html>
