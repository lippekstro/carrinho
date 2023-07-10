<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/carrinho/templates/cabecalho.php';
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
    <a href="/carrinho/views/admin/cadastrar_produto.php" class="btn btn-primary d-inline-flex align-items-center">
        Adicionar Produto
        <i class="bi bi-plus-circle-fill m-1"></i>
    </a>

    <a href="/carrinho/views/admin/listar_produto.php" class="btn btn-primary d-inline-flex align-items-center">
        Listar Produtos
        <i class="bi bi-card-list m-1"></i>
    </a>

</section>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/carrinho/templates/rodape.php';
?>