<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/carrinho/models/produto.php";
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['nv_acesso'] < 2) {
    setcookie('msg', 'Você não tem permissão para acessar este conteúdo', time() + 3600, '/carrinho/');
    setcookie('tipo', 'perigo', time() + 3600, '/carrinho/');
    header('Location: /carrinho/index.php');
    exit();
}

try {
    $nome = htmlspecialchars($_POST['nome']);
    $preco = htmlspecialchars($_POST['preco']);
    if (!empty($_FILES['imagem']['tmp_name'])) {
        $imagem = file_get_contents($_FILES['imagem']['tmp_name']);
    }

    $produto = new Produto();
    $produto->nome_produto = $nome;
    $produto->preco = $preco;
    if ($imagem) {
        $produto->img_produto = $imagem;
    }
    $produto->criar();

    setcookie('sucesso', "O produto $produto->nome_produto foi adicionado com sucesso", time() + 3600, '/');
    header("Location: /carrinho/views/admin/painel_controle.php");
    exit();
} catch (PDOException $e) {
    echo $e->getMessage();
}
