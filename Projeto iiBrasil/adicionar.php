<?php
session_start();
require 'back/conexao.php';
require 'back/verifica.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $titulo = $_POST['titulo'];
    $autor  = $_POST['autor'];
    $genero = $_POST['genero'];
    $resumo = $_POST['resumo'];

    if (!empty($_FILES['imagem']['name'])) {
        $nome = uniqid() . "_" . $_FILES['imagem']['name'];
        $destino = "uploads/" . $nome;
        move_uploaded_file($_FILES['imagem']['tmp_name'], $destino);
    }

$query = "INSERT INTO livros (titulo, autor, genero, resumo, imagem)
          VALUES ('$titulo', '$autor', '$genero', '$resumo', '$nome')";

    if (mysqli_query($conexao, $query)) {
        header("Location: inicio.php");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Livro</title>
    <link rel="stylesheet" href="style/style_adicionar.css">
</head>
<body>

    <div class="caixa-login">

        <h2 style="color: #2e2010;">Novo Livro</h2>

        <form action="adicionar.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="titulo" placeholder="Título do Livro" required>
            <input type="text" name="autor" placeholder="Autor" required>
            
            <select name="genero" required>
                <option value="" disabled selected>Selecione o Gênero</option>
                <option value="Fantasia">Fantasia</option>
                <option value="Romance">Romance</option>
                <option value="Terror">Terror</option>
                <option value="Outros">Outros</option>
            </select>

            <textarea name="resumo" placeholder="Resumo do livro..." rows="4" required></textarea>

            <div style="text-align: left; margin-top: 10px;">
                <label style="font-size: 12px; color: #8b4513;">Capa do Livro:</label>
                <input type="file" name="imagem" accept="image/*" style="font-size: 12px;">
            </div>

            <input type="submit" value="SALVAR LIVRO">
        </form>

        <a href="inicio.php" class="link-voltar">Voltar para a Biblioteca</a>
    </div>

</body>
</html>