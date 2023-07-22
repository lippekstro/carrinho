<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/carrinho/models/usuario.php';

try {
    $email = htmlspecialchars($_POST['email']);
    $senha = htmlspecialchars($_POST['senha']);
    Usuario::logar($email, $senha);
} catch (Exception $e) {
    echo $e->getMessage();
}
