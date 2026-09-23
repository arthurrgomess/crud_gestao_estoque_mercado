<?php
require_once __DIR__ . '/funcoes.php';
$erros = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dados = $_POST;
    $erros = validarDadosProduto($dados);

    if (empty($erros)) {
        cadastrarProduto($pdo, $dados);
        header("Location: ../index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Produto</title>
</head>
<body>
    <h1>Cadastrar Produto</h1>

    <?php if (!empty($erros)): ?>
        <ul style="color:red;">
            <?php foreach ($erros as $erro): ?>
                <li><?= htmlspecialchars($erro) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="POST">
        <label>Nome: <input type="text" name="nome" value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>" required></label><br><br>
        <label>Categoria: <input type="text" name="categoria" value="<?= htmlspecialchars($_POST['categoria'] ?? '') ?>" required></label><br><br>
        <label>Descrição: <textarea name="descricao"><?= htmlspecialchars($_POST['descricao'] ?? '') ?></textarea></label><br><br>
        <label>Preço: <input type="number" step="0.01" name="preco" value="<?= htmlspecialchars($_POST['preco'] ?? '') ?>" required></label><br><br>
        <label>Quantidade em estoque: <input type="number" name="quantidade_estoque" value="<?= htmlspecialchars($_POST['quantidade_estoque'] ?? '') ?>" required></label><br><br>
        <label>Data de validade: <input type="date" name="data_validade" value="<?= htmlspecialchars($_POST['data_validade'] ?? '') ?>" required></label><br><br>
        <button type="submit">Salvar</button>
    </form>

    <p><a href="../index.php">Voltar</a></p>
</body>
</html>
