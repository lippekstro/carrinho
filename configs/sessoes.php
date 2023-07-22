<?php
date_default_timezone_set('America/Fortaleza');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['usuario']['inicio'])) {
    $segundos = time() - $_SESSION['usuario']['inicio'];
    if ($segundos > $_SESSION['usuario']['expira']) {
        header('Location: /carrinho/controllers/logout_controller.php');
    } else {
        $_SESSION['usuario']['inicio'] = time();
    }
}
