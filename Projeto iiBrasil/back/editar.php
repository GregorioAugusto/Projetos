<?php
session_start();
require 'conexao.php';
require 'verifica.php';

$id = intval($_GET['id']);


$busca = "SELECT * FROM livros WHERE id = '$id'";
$resultado = mysqli_query($conexao, $busca);
$livro = mysqli_fetch_assoc($resultado);


if (!$livro) {
    header("Location: ../inicio.php");
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $titulo = $_POST['titulo'];
    $autor  = $_POST['autor'];
    $genero = $_POST['genero'];
    $resumo = $_POST['resumo'];
    $imagem_antiga = $_POST['imagem_antiga']; 
    $nome_imagem_final = $imagem_antiga;


    if (!empty($_FILES['imagem']['name'])) {
        $nome_novo = uniqid() . "_" . $_FILES['imagem']['name'];
        $destino = "uploads/" . $nome_novo;

        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $destino)) {
            $nome_imagem_final = $nome_novo;
 
        }
    }


    $atulizar = "UPDATE livros SET 
                     titulo = '$titulo', 
                     autor = '$autor', 
                     genero = '$genero', 
                     resumo = '$resumo', 
                     imagem = '$nome_imagem_final' 
                     WHERE id = '$id'";

    if (mysqli_query($conexao, $atulizar)) {
        header("Location: ../inicio.php");
        exit;
    } else {
        echo "Erro ao atualizar: " . mysqli_error($conexao);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Livro</title>
    <link rel="stylesheet" href="../style/style_adicionar.css">
</head>

<body>

    <div class="caixa-login">

        <h2 style="color: #2e2010;">Editar Livro</h2>

        <form action="" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="imagem_antiga" value="<?php echo $livro['imagem']; ?>">

            <input type="text" name="titulo" placeholder="Título do Livro"
                value="<?php echo htmlspecialchars($livro['titulo']); ?>" required>

            <input type="text" name="autor" placeholder="Autor"
                value="<?php echo htmlspecialchars($livro['autor']); ?>" required>

            <select name="genero" required>
                <option value="" disabled>Selecione o Gênero</option>
                <option value="Fantasia" <?php if ($livro['genero'] == 'Fantasia') echo 'selected'; ?>>Fantasia</option>
                <option value="Romance" <?php if ($livro['genero'] == 'Romance') echo 'selected'; ?>>Romance</option>
                <option value="Terror" <?php if ($livro['genero'] == 'Terror') echo 'selected'; ?>>Terror</option>
                <option value="Outros" <?php if ($livro['genero'] == 'Outros') echo 'selected'; ?>>Outros</option>
            </select>

            <textarea name="resumo" placeholder="Resumo do livro..." rows="4" required><?php echo htmlspecialchars($livro['resumo']); ?></textarea>

            <div style="text-align: left; margin-top: 10px;">
                <label style="font-size: 12px; color: #8b4513;">Capa Atual: <?php echo htmlspecialchars($livro['imagem']); ?></label>
                <br>
                <label style="font-size: 12px; color: #8b4513;">Trocar Capa (Opcional):</label>
                <input type="file" name="imagem" accept="image/*" style="font-size: 12px;">
            </div>

            <input type="submit" value="SALVAR ALTERAÇÕES">
        </form>

        <a href="../inicio.php" class="link-voltar">Cancelar e Voltar</a>
    </div>

</body>

</html>