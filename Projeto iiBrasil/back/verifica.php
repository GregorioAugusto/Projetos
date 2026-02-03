<?php
if (!isset($_SESSION['usuario'])) {//se nao existir a sessao do usuario, redireciona para a pagina de login
    header('Location: index.php');
    exit();
}

?>