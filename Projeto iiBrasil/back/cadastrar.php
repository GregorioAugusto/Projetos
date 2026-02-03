<?php
if(isset($_POST['cadastrar'])){ //caso o botao cadastrar seja clicado, salva os dados no banco de dados, que o usuario digitou no formulario
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $salvar = "INSERT INTO login (usuario, senha) VALUES ('$usuario', '$senha')";//comando sql para inserir os dados no banco de login
    $resultado = mysqli_query($conexao, $salvar);

    if($resultado){
        echo "<script>alert('Cadastrado com sucesso! Agora faça login.');</script>";//caso de certo, mostra essa mensagem
    } else {
        echo "<script>alert('Erro ao cadastrar.');</script>";//caso de errado, mostra essa mensagem
    }
}

?>