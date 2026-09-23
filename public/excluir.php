<?php
require_once __DIR__ . '/funcoes.php';

$id = $_GET['id'] ?? null;

if ($id) {
    excluirProduto($pdo, $id);
}

header("Location: ../index.php");
exit;
