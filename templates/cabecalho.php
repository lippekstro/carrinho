<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/carrinho/configs/sessoes.php";

if (!isset($_COOKIE['modo'])) {
    setcookie('modo', 'claro', time() + (30 * 30 * 30), '/');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['claro'])) {
        setcookie('modo', 'claro', time() + (3600 * 24 * 30), '/');
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    } elseif (isset($_POST['escuro'])) {
        setcookie('modo', 'escuro', time() + (3600 * 24 * 30), '/');
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
    <title>Cart</title>
    <link rel="shortcut icon" href="/carrinho/img/your-logo_16.png" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous" defer></script>

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
                        <?php if (isset($_SESSION['usuario'])) : ?>
                            <li class="nav-item">
                                <span>Bem Vindo, <?= $_SESSION['usuario']['nome'] ?></span>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/carrinho/index.php">Inicio<i class="bi bi-house-fill"></i></a>
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
                            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" class="container-fluid justify-content-start">
                                <button name="escuro" class="btn btn-sm btn-outline-secondary" type="submit"><i class="bi bi-moon-fill"></i></button>
                            </form>
                        <?php else : ?>
                            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" class="container-fluid justify-content-start">
                                <button name="claro" class="btn btn-sm btn-outline-secondary" type="submit"><i class="bi bi-brightness-high-fill"></i></button>
                            </form>
                        <?php endif; ?>
                        <?php if (!isset($_SESSION['usuario'])) : ?>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="/carrinho/views/login.php">Login<i class="bi bi-door-open-fill"></i></a>
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="/carrinho/controllers/logout_controller.php">Sair<i class="bi bi-door-closed-fill"></i></a>
                            </li>
                        <?php endif; ?>
                    </div>

                </ul>
            </div>
        </div>
    </nav>
    <main>