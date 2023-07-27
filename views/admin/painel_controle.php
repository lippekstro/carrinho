<?php
if (isset($_COOKIE['msg'])){
    setcookie('msg', '', time() - 3600, '/carrinho/');
    setcookie('tipo', '', time() - 3600, '/carrinho/');
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/carrinho/templates/cabecalho.php';

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['nv_acesso'] < 2) {
    setcookie('msg', 'Você não tem permissão para acessar este conteúdo', time() + 3600, '/carrinho/');
    setcookie('tipo', 'perigo', time() + 3600, '/carrinho/');
    header('Location: /carrinho/index.php');
    exit();
}

?>

<section>
    <?php if (isset($_COOKIE['msg'])) : ?>
        <?php if ($_COOKIE['tipo'] === 'sucesso') : ?>
            <div class="alert alert-success text-center m-3" role="alert">
                <?= $_COOKIE['msg'] ?>
            </div>
        <?php elseif ($_COOKIE['tipo'] === 'perigo') : ?>
            <div class="alert alert-danger text-center m-3" role="alert">
                <?= $_COOKIE['msg'] ?>
            </div>
        <?php else : ?>
            <div class="alert alert-info text-center m-3" role="alert">
                <?= $_COOKIE['msg'] ?>
            </div>
        <?php endif; ?>
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