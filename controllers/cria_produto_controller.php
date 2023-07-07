<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/carrinho/models/produto.php";

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
