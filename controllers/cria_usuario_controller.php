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
    // Extrai o código SQLSTATE do erro
    $sqlStateCode = $e->getCode();
    // Extrai a mensagem de erro específica do banco de dados
    $errorMessage = $e->getMessage();

    // Verifica se o erro é de chave duplicada (email já cadastrado)
    if ($sqlStateCode === '23000' && strpos($errorMessage, 'Duplicate entry') !== false) {
        setcookie('erro', "O email já foi cadastrado. Por favor, utilize outro email.", time() + 3600, '/carrinho/');
        header('Location: /carrinho/views/cadastro.php');
    } else {
        echo "Erro no banco de dados: " . $errorMessage;
    }
    exit();
}
