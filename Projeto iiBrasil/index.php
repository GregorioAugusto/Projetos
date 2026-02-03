<?php 
if(isset($_SESSION['usuario'])){
    header('Location: inicio.php');
    exit();
}

session_start();
require 'back/conexao.php'; 
require 'back/login.php';
require 'back/cadastrar.php';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca - Acesso</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel='stylesheet' href="style/style_index.css">
</head>
<body>

    <div class="caixa-login">


        <div id="tela-login">
            <h1>Login</h1>
            <form action="" method="POST">
                <input type="text" name="usuario" placeholder="Usuário" required>
                <input type="password" name="senha" placeholder="Senha" required>
                <input type="submit" name="entrar" value="ENTRAR">
            </form>
            
            <div class="link-trocar" onclick="trocarTela()">
                Não tem conta?
            </div>
        </div>

        <div id="tela-cadastro" style="display: none;">
            <h1>Cadastro</h1>
            <form action="" method="POST">
                <input type="text" name="usuario" placeholder="Crie um Usuário" required>
                <input type="password" name="senha" placeholder="Crie uma Senha" required>
                <input type="submit" name="cadastrar" value="CADASTRAR">
            </form>
            
            <div class="link-trocar" onclick="trocarTela()">
                Voltar para Login.
            </div>
        </div>

    </div>

    <script>
        function trocarTela() {
            var login = document.getElementById('tela-login');
            var cadastro = document.getElementById('tela-cadastro');

            if (login.style.display === 'none') {
                login.style.display = 'block';
                cadastro.style.display = 'none';
            } else {
                login.style.display = 'none';
                cadastro.style.display = 'block';
            }
        }
    </script>

</body>
</html>