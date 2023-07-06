<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/carrinho/db/conexao.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/carrinho/models/usuario.php';

/* session_start(); */

$email = htmlspecialchars($_POST['email']);
$senha = htmlspecialchars($_POST['senha']);

try {
    Usuario::logar($email, $senha);
} catch (Exception $e) {
    echo $e->getMessage();
}
