<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/carrinho/models/usuario.php';

try {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    Usuario::logar($email, $senha);
} catch (Exception $e) {
    echo $e->getMessage();
}
