<?php
session_start();
session_destroy();//o logout do codigo, quebra a sessao do usuario e redireciona para a pagina de login
header('Location: index.php');
exit();
?>