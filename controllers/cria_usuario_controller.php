<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/carrinho/models/usuario.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/carrinho/configs/utils.php";
session_start();

try {
    $nome = Utilidades::sanitizaString($_POST['nome']);
    
    if(Utilidades::validaEmail($_POST['email'])){
        $email = Utilidades::sanitizaEmail($_POST['email']);
    } else {
        setcookie('msg', "Email inválido.", time() + 3600, '/carrinho/');
        setcookie('tipo', 'perigo', time() + 3600, '/carrinho/');
        header("Location: /carrinho/views/cadastro.php");
        exit();
    }
    
    $senha = $_POST['senha'];
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
        setcookie('msg', "O email já foi cadastrado. Por favor, utilize outro email.", time() + 3600, '/carrinho/');
        setcookie('tipo', 'info', time() + 3600, '/carrinho/');
        header('Location: /carrinho/views/cadastro.php');
    } else {
        echo "Erro no banco de dados: " . $errorMessage;
    }
    exit();
}
