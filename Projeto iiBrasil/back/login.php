<?php
if(isset($_POST['entrar'])){
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $busca = "SELECT * FROM login WHERE usuario = '$usuario' AND senha = '$senha'";
    $resultado = mysqli_query($conexao, $busca);

    if(mysqli_num_rows($resultado) == 1){
        $_SESSION['usuario'] = $usuario;
        header('Location: inicio.php');
        exit();
    } else {
        echo "<script>alert('Usuário ou senha incorretos!');</script>";
    }
}
?>