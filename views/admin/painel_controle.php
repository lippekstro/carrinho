<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/carrinho/templates/cabecalho.php';
?>

<section class="d-flex justify-content-evenly m-3">
    <a href="/carrinho/views/admin/cadastrar_produto.php" class="btn btn-primary d-inline-flex align-items-center">
        Adicionar Produto
        <i class="bi bi-plus-circle-fill m-1"></i>
    </a>

</section>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/carrinho/templates/rodape.php';
?>