<?php
require_once __DIR__ . '/../infra/conexao.php';

function listarProdutos($pdo) {
    $stmt = $pdo->query("SELECT * FROM produtos ORDER BY nome");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function buscarProdutoPorId($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function validarDadosProduto($dados) {
    $erros = [];
    if (empty($dados['nome'])) $erros[] = "O nome é obrigatório.";
    if (empty($dados['categoria'])) $erros[] = "A categoria é obrigatória.";
    if (!is_numeric($dados['preco'] ?? '') || $dados['preco'] < 0) $erros[] = "Preço inválido.";
    if (!is_numeric($dados['quantidade_estoque'] ?? '') || $dados['quantidade_estoque'] < 0) $erros[] = "Quantidade em estoque inválida.";
    if (empty($dados['data_validade'])) $erros[] = "A data de validade é obrigatória.";
    return $erros;
}

function cadastrarProduto($pdo, $dados) {
    $sql = "INSERT INTO produtos (nome, categoria, descricao, preco, quantidade_estoque, data_validade) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        $dados['nome'],
        $dados['categoria'],
        $dados['descricao'] ?? '',
        $dados['preco'],
        $dados['quantidade_estoque'],
        $dados['data_validade'],
    ]);
}

function editarProduto($pdo, $id, $dados) {
    $sql = "UPDATE produtos SET nome = ?, categoria = ?, descricao = ?, preco = ?, quantidade_estoque = ?, data_validade = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        $dados['nome'],
        $dados['categoria'],
        $dados['descricao'] ?? '',
        $dados['preco'],
        $dados['quantidade_estoque'],
        $dados['data_validade'],
        $id,
    ]);
}

function excluirProduto($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM produtos WHERE id = ?");
    return $stmt->execute([$id]);
}
