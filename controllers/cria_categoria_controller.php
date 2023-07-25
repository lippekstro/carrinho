<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/carrinho/models/categoria.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/carrinho/configs/utils.php";
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['nv_acesso'] < 2) {
    setcookie('msg', 'Você não tem permissão para acessar este conteúdo', time() + 3600, '/carrinho/');
    setcookie('tipo', 'perigo', time() + 3600, '/carrinho/');
    header('Location: /carrinho/index.php');
    exit();
}

try {
    $nome = Utilidades::sanitizaString($_POST['nome']);

    $categoria = new Categoria();
    $categoria->nome_categoria = $nome;
    $categoria->criar();

    setcookie('sucesso', "A categoria $categoria->nome_categoria foi adicionada com sucesso", time() + 3600, '/');
    header("Location: /carrinho/views/admin/painel_controle.php");
    exit();
} catch (PDOException $e) {
    echo $e->getMessage();
}
