<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/carrinho/models/produto.php";
// Verifica se o ID do produto foi fornecido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $produtoId = $_GET['id'];

    try {
        $produto = new Produto($produtoId);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    if ($produto) {
        // Verifica se o carrinho já possui o produto
        $carrinho = isset($_COOKIE['carrinho']) ? unserialize($_COOKIE['carrinho']) : array();

        if (isset($carrinho[$produtoId])) {
            // Atualiza a quantidade do produto no carrinho
            $carrinho[$produtoId]['quantidade']++;
        } else {
            // Adiciona um novo item ao carrinho
            $carrinho[$produtoId] = array(
                'id_produto' => $produto->id_produto,
                'nome' => $produto->nome_produto,
                'preco' => $produto->preco,
                'quantidade' => 1
            );
        }

        // Salva o carrinho como cookie
        setcookie('carrinho', serialize($carrinho), time() + (86400 * 30), '/');

        setcookie('adicionado', "O produto foi adicionado ao carrinho com sucesso!", time() + 3600, '/');
        header('Location: /carrinho/index.php');
        exit();
    }
}
