<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/carrinho/models/usuario.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/carrinho/configs/utils.php';
require_once $_SERVER["DOCUMENT_ROOT"] . "/carrinho/configs/sessoes.php";

if (!isset($_SESSION['usuario'])) {
    setcookie('msg', 'Você não tem permissão para acessar este conteúdo', time() + 3600, '/carrinho/');
    setcookie('tipo', 'perigo', time() + 3600, '/carrinho/');
    header('Location: /carrinho/index.php');
    exit();
}

try {
    $id_usuario = $_SESSION['usuario']['id'];
    $nome = Utilidades::sanitizaString($_POST['nome']);

    if (Utilidades::validaEmail($_POST['email'])) {
        $email = Utilidades::sanitizaEmail($_POST['email']);
    } else {
        setcookie('msg', "Email inválido.", time() + 3600, '/carrinho/');
        setcookie('tipo', 'perigo', time() + 3600, '/carrinho/');
        header("Location: /carrinho/views/editar_perfil.php");
        exit();
    }

    if (!empty($_FILES['imagem']['tmp_name'])) {
        $imagem = file_get_contents($_FILES['imagem']['tmp_name']);
    }

    $usuario = new Usuario($id_usuario);
    $usuario->nome_usuario = $nome;
    $usuario->email = $email;
    if ($imagem) {
        $usuario->img_usuario = $imagem;
        $usuario->editarFoto();
        $_SESSION['usuario']['img_usuario'] = $imagem;
    } else {
        $usuario->editar();
    }

    $_SESSION['usuario']['nome'] = $nome;
    $_SESSION['usuario']['email'] = $email;


    /* setcookie('sucesso', "A categoria $categoria->nome_categoria foi atualizada com sucesso", time() + 3600, '/'); */
    header("Location: /carrinho/index.php");
    exit();
} catch (PDOException $e) {
    echo $e->getMessage();
}
