<?php
session_start();
session_destroy();  // Destruir todas as variáveis de sessão
header('Location: login.php');  // Redireciona para a página de login
exit;
?>
