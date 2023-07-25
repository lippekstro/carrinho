<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/carrinho/models/categoria.php';
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['nv_acesso'] < 2) {
    setcookie('msg', 'Você não tem permissão para acessar este conteúdo', time() + 3600, '/carrinho/');
    setcookie('tipo', 'perigo', time() + 3600, '/carrinho/');
    header('Location: /carrinho/index.php');
    exit();
}

try {
    $id_categoria = htmlspecialchars($_POST['id']);
    $nome = htmlspecialchars($_POST['nome']);

    $categoria = new Categoria($id_categoria);
    $categoria->nome_categoria = $nome;
    $categoria->editar();

    setcookie('sucesso', "A categoria $categoria->nome_categoria foi atualizada com sucesso", time() + 3600, '/');
    header("Location: /carrinho/views/admin/listar_categoria.php");
} catch (PDOException $e) {
    echo $e->getMessage();
}
