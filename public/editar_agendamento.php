<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php'); // Redireciona para o login se não estiver logado
    exit;
}

include_once '../src/model/Agendamento.php';
include_once '../config/Database.php';

if (isset($_GET['id'])) {
    // Criar a conexão com o banco de dados
    $database = new Database();
    $db = $database->getConnection();

    // Criar o objeto Agendamento
    $agendamento = new Agendamento($db);
    
    // Definir o ID do agendamento
    $agendamento->id_agendamento = $_GET['id'];

    // Obter os dados do agendamento
    if ($agendamento->readOne()) {
        // Exibir os dados do agendamento no formulário
        $data = $agendamento->data;
        $hora = $agendamento->hora;
        $motivo = $agendamento->motivo;
        $id_cliente = $agendamento->id_cliente;
        $id_animal = $agendamento->id_animal;
    } else {
        echo "Agendamento não encontrado.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Atualizar os dados do agendamento
    $agendamento->data = $_POST['data'];
    $agendamento->hora = $_POST['hora'];
    $agendamento->motivo = $_POST['motivo'];
    $agendamento->id_cliente = $_POST['id_cliente'];
    $agendamento->id_animal = $_POST['id_animal'];

    if ($agendamento->update()) {
        header("Location: agendamentos.php"); // Redireciona para a lista de agendamentos
    } else {
        echo "Erro ao atualizar o agendamento!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Agendamento</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="dashboard-container">
        <h2>Editar Agendamento</h2>
        <form action="editar_agendamento.php?id=<?php echo $agendamento->id_agendamento; ?>" method="POST">
            <label for="data">Data:</label>
            <input type="date" name="data" id="data" value="<?php echo $data; ?>" required><br><br>

            <label for="hora">Hora:</label>
            <input type="time" name="hora" id="hora" value="<?php echo $hora; ?>" required><br><br>

            <label for="motivo">Motivo:</label>
            <input type="text" name="motivo" id="motivo" value="<?php echo $motivo; ?>" required><br><br>

            <label for="id_cliente">ID do Cliente:</label>
            <input type="number" name="id_cliente" id="id_cliente" value="<?php echo $id_cliente; ?>" required><br><br>

            <label for="id_animal">ID do Animal:</label>
            <input type="number" name="id_animal" id="id_animal" value="<?php echo $id_animal; ?>" required><br><br>

            <button type="submit">Atualizar Agendamento</button>
        </form>
    </div>
</body>
</html>
