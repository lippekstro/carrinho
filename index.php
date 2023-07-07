<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/carrinho/templates/cabecalho.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/carrinho/models/produto.php';

try {
    $produtos = Produto::listar();
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>

<?php if (isset($_COOKIE['adicionado'])) : ?>
    <p class="text-success text-center"><?= $_COOKIE['adicionado'] ?></p>
    <?php setcookie('adicionado', '', time() - 3600, '/') ?>
<?php endif; ?>

<div class="d-flex justify-content-center m-3">
    <div id="carouselExampleCaptions" class="carousel slide w-50">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/random/1920x1080/?shirt" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Camisas</h5>
                    <p>As melhores camisas de marca.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/random/1920x1080/?pants" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Calças</h5>
                    <p>Encontre aquela que cabe em você.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/random/1920x1080/?boots" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Botas</h5>
                    <p>Vaqueira.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<div class="d-flex justify-content-evenly flex-wrap m-3">
    <?php foreach($produtos as $p): ?>
    <div class="card" style="width: 18rem;">
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