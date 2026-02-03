<?php

if(isset($_POST['cadastrar'])){
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $salvar = "INSERT INTO login (usuario, senha) VALUES ('$usuario', '$senha')";
    $resultado = mysqli_query($conexao, $salvar);

    if($resultado){
        echo "<script>alert('Cadastrado com sucesso! Agora faça login.');</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar.');</script>";
    }
}

?>