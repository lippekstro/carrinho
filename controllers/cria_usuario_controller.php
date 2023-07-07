<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/carrinho/models/usuario.php";
session_start();

try {
    $nome = htmlspecialchars($_POST['nome']);
    $email = htmlspecialchars($_POST['email']);
    $senha = htmlspecialchars($_POST['senha']);
    $senha = password_hash($senha, PASSWORD_DEFAULT);
    if (!empty($_FILES['imagem']['tmp_name'])) {
        $imagem = file_get_contents($_FILES['imagem']['tmp_name']);
    }

    $usuario = new Usuario();
    $usuario->nome_usuario = $nome;
    $usuario->email = $email;
    $usuario->senha = $senha;
    if ($imagem) {
        $usuario->img_usuario = $imagem;
    }
    $usuario->criar();

    header("Location: /carrinho/index.php");
    exit();
} catch (PDOException $e) {
    echo $e->getMessage();
}
