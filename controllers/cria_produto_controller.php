<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/carrinho/models/produto.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/carrinho/configs/utils.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/carrinho/configs/sessoes.php";

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['nv_acesso'] < 2) {
    setcookie('msg', 'Você não tem permissão para acessar este conteúdo', time() + 3600, '/carrinho/');
    setcookie('tipo', 'perigo', time() + 3600, '/carrinho/');
    header('Location: /carrinho/index.php');
    exit();
}

try {
    $nome = Utilidades::sanitizaString($_POST['nome']);

    if (Utilidades::validaFloat($_POST['preco'])) {
        $preco = htmlspecialchars($_POST['preco']);
    } else {
        setcookie('msg', "Preço inválido.", time() + 3600, '/carrinho/');
        setcookie('tipo', 'perigo', time() + 3600, '/carrinho/');
        header("Location: /carrinho/views/admin/cadastrar_produto.php");
        exit();
    }

    $categoria = htmlspecialchars($_POST['id_categoria']);

    if (!empty($_FILES['imagem']['tmp_name'])) {
        $imagem = file_get_contents($_FILES['imagem']['tmp_name']);
    }

    $produto = new Produto();
    $produto->nome_produto = $nome;
    $produto->preco = $preco;
    $produto->id_categoria = $categoria;
    if ($imagem) {
        $produto->img_produto = $imagem;
    }
    $produto->criar();

    setcookie('msg', "O produto $produto->nome_produto foi adicionado com sucessoo!", time() + 3600, '/carrinho/');
    setcookie('tipo', 'sucesso', time() + 3600, '/carrinho/');
    header("Location: /carrinho/views/admin/painel_controle.php");
    exit();
} catch (PDOException $e) {
    echo $e->getMessage();
}
