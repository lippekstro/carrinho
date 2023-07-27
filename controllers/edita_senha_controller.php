<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/carrinho/models/usuario.php';
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['nv_acesso'] < 2) {
    setcookie('msg', 'Você não tem permissão para acessar este conteúdo', time() + 3600, '/carrinho/');
    setcookie('tipo', 'perigo', time() + 3600, '/carrinho/');
    header('Location: /carrinho/index.php');
    exit();
}

try {
    $id_usuario = $_SESSION['usuario']['id'];
    $senha = $_POST['senha'];
    $senha = password_hash($senha, PASSWORD_DEFAULT);

    $usuario = new Usuario($id_usuario);
    $usuario->senha = $senha;
    $usuario->editarSenha();


    /* setcookie('sucesso', "A categoria $categoria->nome_categoria foi atualizada com sucesso", time() + 3600, '/'); */
    header("Location: /carrinho/controllers/logout_controller.php");
} catch (PDOException $e) {
    echo $e->getMessage();
}
