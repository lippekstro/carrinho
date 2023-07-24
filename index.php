<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/carrinho/templates/cabecalho.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/carrinho/models/produto.php';

try {
    $produtos = Produto::listar();
    $produtosNovos = Produto::listarUltimos();
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>

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
    <?php setcookie('msg', '', time() - 3600, '/carrinho/') ?>
    <?php setcookie('tipo', '', time() - 3600, '/carrinho/') ?>
<?php endif; ?>

<div class="d-flex justify-content-center m-3">
    <div id="carouselExampleCaptions" class="carousel slide col col-lg-6">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <?php foreach ($produtosNovos as $pn) : ?>
                <div class="carousel-item active">
                    <img src="data:image/jpg;charset=utf8;base64,<?= base64_encode($pn['img_produto']); ?>" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Camisas</h5>
                        <p>As melhores camisas de marca.</p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon text-bg-info" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon text-bg-info" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<div class="d-flex justify-content-evenly flex-wrap m-3">
    <?php foreach ($produtos as $p) : ?>
        <div class="card m-3" style="width: 18rem;">
            <img src="data:image/jpg;charset=utf8;base64,<?= base64_encode($p['img_produto']); ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text"><?= $p['nome_produto'] ?></p>
                <p class="card-text"><?= $p['preco'] ?>R$</p>
                <a href="/carrinho/controllers/adicionar_item_controller.php?id=<?= $p['id_produto'] ?>" class="btn btn-primary">Carrinho</a>
            </div>
        </div>
    <?php endforeach; ?>

</div>


<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/carrinho/templates/rodape.php';
?>