<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php'); // Redireciona para o login se não estiver logado
    exit;
}

include_once '../src/model/Agendamento.php';
include_once '../config/Database.php';

$data = $hora = $motivo = $id_cliente = $id_animal = "";
$data_err = $hora_err = $motivo_err = $id_cliente_err = $id_animal_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Criar a conexão com o banco de dados
    $database = new Database();
    $db = $database->getConnection();

    // Criar o objeto Agendamento
    $agendamento = new Agendamento($db);

    // Receber os dados do formulário
    $agendamento->data = $_POST['data'];
    $agendamento->hora = $_POST['hora'];
    $agendamento->motivo = $_POST['motivo'];
    $agendamento->id_cliente = $_POST['id_cliente'];
    $agendamento->id_animal = $_POST['id_animal'];

    // Tentar adicionar o agendamento ao banco de dados
    if ($agendamento->create()) {
        header("Location: agendamentos.php");
    } else {
        echo "Erro ao adicionar o agendamento!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Agendamento</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="dashboard-container">
        <h2>Adicionar Novo Agendamento</h2>
        <form action="adicionar_agendamento.php" method="POST">
            <label for="data">Data:</label>
            <input type="date" name="data" id="data" required><br><br>

            <label for="hora">Hora:</label>
            <input type="time" name="hora" id="hora" required><br><br>

            <label for="motivo">Motivo:</label>
            <input type="text" name="motivo" id="motivo" required><br><br>

            <label for="id_cliente">ID do Cliente:</label>
            <input type="number" name="id_cliente" id="id_cliente" required><br><br>

            <label for="id_animal">ID do Animal:</label>
            <input type="number" name="id_animal" id="id_animal" required><br><br>

            <button type="submit">Adicionar Agendamento</button>
        </form>
    </div>
</body>
</html>
