<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/carrinho/templates/cabecalho.php';

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['nv_acesso'] < 2) {
    setcookie('msg', 'Você não tem permissão para acessar este conteúdo', time() + 3600, '/carrinho/');
    setcookie('tipo', 'perigo', time() + 3600, '/carrinho/');
    header('Location: /carrinho/index.php');
    exit();
}

?>

<section>
    <?php if (isset($_COOKIE['sucesso'])) : ?>
        <div class="alert alert-success text-center m-3" role="alert">
            <?= $_COOKIE['sucesso'] ?>
        </div>
        <?php setcookie('sucesso', '', time() - 3600, '/') ?>
    <?php endif; ?>
</section>

<section class="d-flex justify-content-evenly flex-wrap m-3">
    <a href="/carrinho/views/admin/cadastrar_produto.php" class="btn btn-primary d-inline-flex align-items-center m-3">
        Adicionar Produto
        <i class="bi bi-plus-circle-fill m-1"></i>
    </a>

    <a href="/carrinho/views/admin/cadastrar_categoria.php" class="btn btn-primary d-inline-flex align-items-center m-3">
        Adicionar Categoria
        <i class="bi bi-plus-circle-fill m-1"></i>
    </a>

    <a href="/carrinho/views/admin/listar_produto.php" class="btn btn-primary d-inline-flex align-items-center m-3">
        Listar Produtos
        <i class="bi bi-card-list m-1"></i>
    </a>

    <a href="/carrinho/views/admin/listar_categoria.php" class="btn btn-primary d-inline-flex align-items-center m-3">
        Listar Categorias
        <i class="bi bi-card-list m-1"></i>
    </a>

</section>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/carrinho/templates/rodape.php';
?>