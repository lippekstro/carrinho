<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/carrinho/models/produto.php';

try {
    $id_produto = htmlspecialchars($_POST['id']);
    $nome = htmlspecialchars($_POST['nome']);
    $preco = htmlspecialchars($_POST['preco']);
    if (!empty($_FILES['imagem']['tmp_name'])) {
        $imagem = file_get_contents($_FILES['imagem']['tmp_name']);
    }

    $produto = new Produto($id_produto);
    $produto->nome_produto = $nome;
    $produto->preco = $preco;
    if ($imagem) {
        $produto->img_produto = $imagem;
        $produto->editarImagem();
    } else {
        $produto->editar();
    }

    setcookie('sucesso', "O produto $produto->nome_produto foi atualizado com sucesso", time() + 3600, '/');
    header("Location: /carrinho/views/admin/listar_produto.php");
} catch (PDOException $e) {
    echo $e->getMessage();
}
