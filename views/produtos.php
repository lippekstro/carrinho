<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/carrinho/templates/cabecalho.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/carrinho/models/produto.php';

try {
    $id_categoria = $_GET['id_cat'];
    $produtos = Produto::listarPorCategoria($id_categoria);
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>

<?php if (count($produtos) != 0) : ?>
    <div class="d-flex justify-content-evenly flex-wrap m-3">
        <?php foreach ($produtos as $p) : ?>
            <div class="card m-3" style="width: 18rem;">
                <img src="data:image/jpg;charset=utf8;base64,<?= base64_encode($p['img_produto']); ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <p class="card-text"><?= $p['nome_produto'] ?></p>
                        <p class="card-text"><?= $p['nome_categoria'] ?></p>
                    </div>
                    <p class="card-text"><?= $p['preco'] ?>R$</p>
                    <a href="/carrinho/controllers/adicionar_item_controller.php?id=<?= $p['id_produto'] ?>" class="btn btn-primary">Carrinho</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else : ?>
    <div class="alert alert-info text-center m-3" role="alert">
        Não há produtos para essa categoria.
    </div>
<?php endif; ?>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/carrinho/templates/rodape.php';
?>