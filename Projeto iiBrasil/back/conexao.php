<?php

$host = 'localhost'; //local de aplicação
$banco   = 'iibrasil'; //nome do banco de dados
$usuario = 'root'; //padrao do xampp
$senha = ''; //sem senha

$conexao = mysqli_connect($host, $usuario, $senha, $banco); //linha que conecta ao banco de dados
if (!$conexao){
    die("falha na conexão!" . mysqli_connect_error()); //caso a conexao falhe, mostra essa mensagem
}
?>