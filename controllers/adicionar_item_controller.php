<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/carrinho/models/produto.php";

$produtoId = $_GET['id'];

try {
    $produto = new Produto($produtoId);
} catch (PDOException $e) {
    echo $e->getMessage();
}


 // Verificar se o carrinho já existe nos cookies
if (isset($_COOKIE['carrinho'])) {
    // Recuperar o conteúdo atual do carrinho
    $carrinho = json_decode($_COOKIE['carrinho'], true);
} else {
    // Se o carrinho não existir, criar um carrinho vazio
    $carrinho = array();
}

// Adicionar o produto ao carrinho
$carrinho[$produtoId] = isset($carrinho[$produtoId]) ? $carrinho[$produtoId] + 1 : 1;

// Atualizar o cookie de carrinho com o novo conteúdo
setcookie('carrinho', json_encode($carrinho), time() + (86400 * 30), '/'); // Definir cookie com validade de 30 dias (86400 segundos = 1 dia)
setcookie('adicionado', "O produto foi adicionado ao carrinho com sucesso!", time() + 3600, '/');
header('Location: /carrinho/index.php');
