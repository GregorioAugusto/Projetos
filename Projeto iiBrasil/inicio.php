<?php
session_start();
require 'back/conexao.php';
require 'back/verifica.php';


if (isset($_GET['excluir'])) {
    $id = intval($_GET['excluir']);
    $conexao->query("DELETE FROM livros WHERE id = '$id'");
    header("Location: inicio.php");
    exit;
}

$busca = $_GET['busca'] ?? '';
$genero = $_GET['genero'] ?? '';

$sql = "SELECT * FROM livros WHERE (titulo LIKE '%$busca%' OR autor LIKE '%$busca%')";

if (!empty($genero)) {
    $sql .= " AND genero = '$genero'";
}

$sql .= " ORDER BY data_cadastro DESC";

$resultado = $conexao->query($sql);

$generos_sql = "SELECT DISTINCT genero FROM livros ORDER BY genero ASC";
$generos_result = $conexao->query($generos_sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca - Início</title>
    <link rel="stylesheet" href="style/style_inicio.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="pagina-inicio">

    <header class="navbar">
        <div class="logo">📚 Minha Biblioteca</div>
        <div class="acoes-nav">
            <a href="adicionar.php" class="btn-nav">Adicionar Livro</a>
            <a href="back/logout.php" class="btn-nav btn-sair">Sair</a>
        </div>
    </header>

    <div class="container-filtros">
        <form method="GET" action="inicio.php">
            <input type="text" name="busca" placeholder="Buscar título ou autor..." value="<?php echo htmlspecialchars($busca); ?>">

            <select name="genero" onchange="this.form.submit()">
                <option value="">Todos os Gêneros</option>
                <?php while ($mostrar = $generos_result->fetch_assoc()): ?>
                    <option value="<?php echo $mostrar['genero']; ?>" <?php if ($genero == $mostrar['genero']) echo 'selected'; ?>>
                        <?php echo $mostrar['genero']; ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <button type="submit" class="btn-buscar"><i class="fas fa-search"></i></button>
        </form>
    </div>

    <div class="galeria-livros">
        <?php if ($resultado->num_rows > 0): ?>
            <?php while ($livro = $resultado->fetch_assoc()): ?>
                <?php $img = !empty($livro['imagem']) ? "uploads/" . $livro['imagem'] : "uploads/capa_padrao.png"; ?>

                <div class="card-livro">
                    <img src="<?php echo $img; ?>" alt="Capa do livro" class="capa-livro">
                    <div class="card-corpo">
                        <h3><?php echo htmlspecialchars($livro['titulo']); ?></h3>
                        <p class="autor">Por: <?php echo htmlspecialchars($livro['autor']); ?></p>
                        <button onclick="abrirModal(<?php echo $livro['id']; ?>)" class="btn-ler-mais">Leia Mais</button>
                    </div>
                </div>

                <div id="modal-<?php echo $livro['id']; ?>" class="modal-overlay" style="display:none;">
                    <div class="modal-conteudo">
                        <span class="fechar-modal" onclick="fecharModal(<?php echo $livro['id']; ?>)">&times;</span>
                        <div class="modal-grid">
                            <div class="modal-img">
                                <img src="<?php echo $img; ?>" alt="Capa Grande">
                            </div>
                            <div class="modal-info">
                                <h2><?php echo htmlspecialchars($livro['titulo']); ?></h2>
                                <p><strong>Gênero:</strong> <?php echo htmlspecialchars($livro['genero']); ?></p>
                                <p><strong>Autor:</strong> <?php echo htmlspecialchars($livro['autor']); ?></p>
                                <hr>
                                <div class="resumo-texto">
                                    <p><?php echo nl2br(htmlspecialchars($livro['resumo'])); ?></p>
                                </div>
                                <div class="modal-acoes">
                                    <a href="back/editar.php?id=<?php echo $livro['id']; ?>" class="btn-editar">Editar Resumo</a>
                                    <a href="inicio.php?excluir=<?php echo $livro['id']; ?>" class="btn-excluir" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="color: #f3e5ab;">Nenhum livro encontrado.</p>
        <?php endif; ?>
    </div>

    <script>
        function abrirModal(id) {
            document.getElementById('modal-' + id).style.display = 'flex';
        }

        function fecharModal(id) {
            document.getElementById('modal-' + id).style.display = 'none';
        }
        window.onclick = function(e) {
            if (e.target.className === 'modal-overlay') e.target.style.display = "none";
        }
    </script>
</body>

</html>