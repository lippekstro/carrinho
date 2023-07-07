<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/carrinho/models/produto.php';

try {
    $id_produto = $_GET['id'];

    $produto = new Produto($id_produto);

    $produto->deletar();

    setcookie('sucesso', "O produto $produto->nome_produto foi deletado com sucesso", time() + 3600, '/');
    header("Location: /carrinho/views/admin/listar_produto.php");
} catch (Exception $e) {
    echo $e->getMessage();
}