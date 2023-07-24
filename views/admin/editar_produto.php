<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/carrinho/templates/cabecalho.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/carrinho/models/produto.php';

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['nv_acesso'] < 2) {
    setcookie('msg', 'Você não tem permissão para acessar este conteúdo', time() + 3600, '/carrinho/');
    setcookie('tipo', 'perigo', time() + 3600, '/carrinho/');
    header('Location: /carrinho/index.php');
    exit();
}

try {
    $produto = new Produto($_GET['id']);
} catch (Exception $e) {
    echo $e->getMessage();
}
?>

<section class="d-flex align-items-center py-4">
    <div class="form-signin col-8 col-lg-4 m-auto">
        <form action="/carrinho/controllers/edita_produto_controller.php" method="POST" enctype="multipart/form-data">
            <h1 class="h3 mb-3 fw-normal">Editar Produto</h1>

            <input type="hidden" class="form-control" id="floatingInput" name="id" value="<?= $produto->id_produto ?>">

            <div class="form-floating my-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="Nome" name="nome" value="<?= $produto->nome_produto ?>" required>
                <label for="floatingInput">Nome</label>
            </div>

            <div class="form-floating my-3">
                <input type="number" class="form-control" id="floatingInput" name="preco" step="0.01" value="<?= $produto->preco ?>" required>
                <label for="floatingInput">Preço</label>
            </div>

            <div class="form-floating my-3">
                <input type="file" class="form-control" id="floatingInput" name="imagem">
                <label for="floatingInput">Imagem</label>
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit">Editar</button>
        </form>
    </div>

</section>


<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/carrinho/templates/rodape.php';
?>