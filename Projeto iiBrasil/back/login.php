<?php
if(isset($_POST['entrar'])){//botao entrar foi clicado ele pega o usuario e senha digitados e verifica no banco de dados
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $busca = "SELECT * FROM login WHERE usuario = '$usuario' AND senha = '$senha'";
    $resultado = mysqli_query($conexao, $busca);

    if(mysqli_num_rows($resultado) == 1){// se tiver um usuario com esses dados, ele inicia a sessao e redireciona para a pagina inicial
        $_SESSION['usuario'] = $usuario;
        header('Location: inicio.php');
        exit();
    } else {
        echo "<script>alert('Usuário ou senha incorretos!');</script>";
    }
}
?>