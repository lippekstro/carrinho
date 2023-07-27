<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/carrinho/configs/sessoes.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/carrinho/models/categoria.php";

if (!isset($_COOKIE['modo'])) {
    setcookie('modo', 'claro', time() + (3600 * 24 * 30), '/carrinho/');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['claro'])) {
        setcookie('modo', 'claro', time() + (3600 * 24 * 30), '/carrinho/');
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    } elseif (isset($_POST['escuro'])) {
        setcookie('modo', 'escuro', time() + (3600 * 24 * 30), '/carrinho/');
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
}

$qtd = 0;
if (isset($_COOKIE['carrinho'])) {
    foreach (unserialize($_COOKIE['carrinho']) as $p) {
        $qtd += $p['quantidade'];
    }
}

try {
    $categorias = Categoria::listar();
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>


<!DOCTYPE html>
<?php if ($_COOKIE['modo'] === 'claro') : ?>
    <html lang="en">
<?php else : ?>
    <html lang="en" data-bs-theme="dark">
<?php endif; ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="Content-Security-Policy" content="
    default-src 'self';
    style-src 'self' cdn.jsdelivr.net 'unsafe-inline';
    require-trusted-types-for 'script';
    script-src 'self';
    font-src 'self' cdn.jsdelivr.net;
    img-src 'self' data: source.unsplash.com images.unsplash.com;
    object-src 'none';
    connect-src viacep.com.br
    ">

    <title>Cart</title>
    <link rel="shortcut icon" href="/carrinho/img/your-logo_16.png" type="image/x-icon">
    <!-- css bootstrap -->
    <link rel="stylesheet" href="/carrinho/css/bootstrap.css">
    <!-- js bootstrap -->
    <script src="/carrinho/js/bootstrap.bundle.js" defer></script>
    <!-- css personalizado -->
    <link rel="stylesheet" href="/carrinho/css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="/carrinho/img/your-logo_64.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav align-items-center w-100 justify-content-between">
                    <div class="navbar-nav align-items-center">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/carrinho/index.php">Inicio<i class="bi bi-house-fill"></i></a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Produtos
                            </a>
                            <ul class="dropdown-menu">
                                <?php foreach ($categorias as $c) : ?>
                                    <li><a class="dropdown-item" href="/carrinho/views/produtos.php?id_cat=<?= $c['id_categoria'] ?>"><?= $c['nome_categoria'] ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/carrinho/views/carrinho.php">
                                Carrinho
                                <i class="bi bi-cart4"></i>
                                <?php if (isset($_COOKIE['carrinho'])) : ?>
                                    <span class="badge text-bg-secondary"><?= $qtd ?></span>
                                <?php endif; ?>
                            </a>
                        </li>

                        <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']['nv_acesso'] >= 2) : ?>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="/carrinho/views/admin/painel_controle.php">Painel de Controle<i class="bi bi-person-badge-fill"></i></a>
                            </li>
                        <?php endif; ?>


                    </div>

                    <div class="navbar-nav align-items-center">
                        <?php if ($_COOKIE['modo'] === 'claro') : ?>
                            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" class="container-fluid justify-content-start" style="max-width: fit-content;">
                                <button name="escuro" class="btn btn-sm btn-outline-secondary my-1" type="submit"><i class="bi bi-moon-fill"></i></button>
                            </form>
                        <?php else : ?>
                            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" class="container-fluid justify-content-start" style="max-width: fit-content;">
                                <button name="claro" class="btn btn-sm btn-outline-secondary my-1" type="submit"><i class="bi bi-brightness-high-fill"></i></button>
                            </form>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['usuario'])) : ?>
                            <img src="data:image/jpg;charset=utf8;base64,<?= base64_encode($_SESSION['usuario']['img_usuario']); ?>" alt="" id="foto-perfil">

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span>Bem Vindo, <?= $_SESSION['usuario']['nome'] ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="/carrinho/views/editar_perfil.php">Editar Perfil</a></li>
                                    <li><a class="dropdown-item" href="/carrinho/views/editar_senha.php">Editar Senha</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>

                        <?php if (!isset($_SESSION['usuario'])) : ?>
                            <li class="nav-item" style="min-width: fit-content;">
                                <a class="nav-link active" aria-current="page" href="/carrinho/views/login.php">Login<i class="bi bi-door-open-fill"></i></a>
                            </li>
                        <?php else : ?>
                            <li class="nav-item" style="min-width: fit-content;">
                                <a class="nav-link active" aria-current="page" href="/carrinho/controllers/logout_controller.php">Sair<i class="bi bi-door-closed-fill"></i></a>
                            </li>
                        <?php endif; ?>
                    </div>

                </ul>
            </div>
        </div>
    </nav>
    <main>