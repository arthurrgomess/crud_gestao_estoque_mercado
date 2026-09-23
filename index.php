<?php
require_once __DIR__ . '/public/funcoes.php';
$produtos = listarProdutos($pdo);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gestão de Estoque - Mercado</title>
</head>
<body>
    <h1>Produtos em Estoque</h1>
    <p><a href="public/cadastrar.php">+ Novo produto</a></p>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Nome</th>
            <th>Categoria</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Estoque</th>
            <th>Validade</th>
            <th>Ações</th>
        </tr>
        <?php if (empty($produtos)): ?>
        <tr>
            <td colspan="7">Nenhum produto cadastrado ainda.</td>
        </tr>
        <?php endif; ?>
        <?php foreach ($produtos as $p): ?>
        <tr>
            <td><?= htmlspecialchars($p['nome']) ?></td>
            <td><?= htmlspecialchars($p['categoria']) ?></td>
            <td><?= htmlspecialchars($p['descricao']) ?></td>
            <td>R$ <?= number_format($p['preco'], 2, ',', '.') ?></td>
            <td><?= (int) $p['quantidade_estoque'] ?></td>
            <td><?= date('d/m/Y', strtotime($p['data_validade'])) ?></td>
            <td>
                <a href="public/editar.php?id=<?= $p['id'] ?>">Editar</a> |
                <a href="public/excluir.php?id=<?= $p['id'] ?>" onclick="return confirm('Excluir este produto?')">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
