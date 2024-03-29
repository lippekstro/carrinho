<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/carrinho/models/produto.php';
require_once $_SERVER["DOCUMENT_ROOT"] . "/carrinho/configs/sessoes.php";

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['nv_acesso'] < 2) {
    setcookie('msg', 'Você não tem permissão para acessar este conteúdo', time() + 3600, '/carrinho/');
    setcookie('tipo', 'perigo', time() + 3600, '/carrinho/');
    header('Location: /carrinho/index.php');
    exit();
}

try {
    $id_produto = htmlspecialchars($_POST['id']);
    $nome = htmlspecialchars($_POST['nome']);
    $preco = htmlspecialchars($_POST['preco']);
    $categoria = htmlspecialchars($_POST['id_categoria']);
    if (!empty($_FILES['imagem']['tmp_name'])) {
        $imagem = file_get_contents($_FILES['imagem']['tmp_name']);
    }

    $produto = new Produto($id_produto);
    $produto->nome_produto = $nome;
    $produto->preco = $preco;
    $produto->id_categoria = $categoria;
    if ($imagem) {
        $produto->img_produto = $imagem;
        $produto->editarImagem();
    } else {
        $produto->editar();
    }

    setcookie('msg', "O produto $produto->nome_produto foi atualizado com sucesso!", time() + 3600, '/carrinho/');
    setcookie('tipo', 'sucesso', time() + 3600, '/carrinho/');
    header("Location: /carrinho/views/admin/listar_produto.php");
    exit();
} catch (PDOException $e) {
    echo $e->getMessage();
}
