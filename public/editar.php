<?php
require_once __DIR__ . '/funcoes.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: ../index.php");
    exit;
}

$produto = buscarProdutoPorId($pdo, $id);
if (!$produto) {
    die("Produto não encontrado.");
}

$erros = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dados = $_POST;
    $erros = validarDadosProduto($dados);

    if (empty($erros)) {
        editarProduto($pdo, $id, $dados);
        header("Location: ../index.php");
        exit;
    }
    
    $produto = $dados;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
</head>
<body>
    <h1>Editar Produto</h1>

    <?php if (!empty($erros)): ?>
        <ul style="color:red;">
            <?php foreach ($erros as $erro): ?>
                <li><?= htmlspecialchars($erro) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="POST">
        <label>Nome: <input type="text" name="nome" value="<?= htmlspecialchars($produto['nome']) ?>" required></label><br><br>
        <label>Categoria: <input type="text" name="categoria" value="<?= htmlspecialchars($produto['categoria']) ?>" required></label><br><br>
        <label>Descrição: <textarea name="descricao"><?= htmlspecialchars($produto['descricao']) ?></textarea></label><br><br>
        <label>Preço: <input type="number" step="0.01" name="preco" value="<?= htmlspecialchars($produto['preco']) ?>" required></label><br><br>
        <label>Quantidade em estoque: <input type="number" name="quantidade_estoque" value="<?= htmlspecialchars($produto['quantidade_estoque']) ?>" required></label><br><br>
        <label>Data de validade: <input type="date" name="data_validade" value="<?= htmlspecialchars($produto['data_validade']) ?>" required></label><br><br>
        <button type="submit">Atualizar</button>
    </form>

    <p><a href="../index.php">Voltar</a></p>
</body>
</html>
