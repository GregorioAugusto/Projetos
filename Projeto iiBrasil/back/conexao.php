<?php

$host = 'localhost';
$banco   = 'iibrasil';
$usuario = 'root';
$senha = '';

$conexao = mysqli_connect($host, $usuario, $senha, $banco);
if (!$conexao){
    die("falha na conexão!" . mysqli_connect_error());
}
?>