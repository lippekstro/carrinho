<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/carrinho/models/produto.php';
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['nv_acesso'] < 2) {
    setcookie('msg', 'Você não tem permissão para acessar este conteúdo', time() + 3600, '/carrinho/');
    setcookie('tipo', 'perigo', time() + 3600, '/carrinho/');
    header('Location: /carrinho/index.php');
    exit();
}

try {
    $id_produto = $_GET['id'];

    $produto = new Produto($id_produto);

    $produto->deletar();

    setcookie('sucesso', "O produto $produto->nome_produto foi deletado com sucesso", time() + 3600, '/');
    header("Location: /carrinho/views/admin/listar_produto.php");
} catch (Exception $e) {
    echo $e->getMessage();
}
