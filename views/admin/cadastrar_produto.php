<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/carrinho/templates/cabecalho.php';
?>

<section class="d-flex align-items-center py-4">
    <div class="form-signin w-25 m-auto">
        <form action="/carrinho/controllers/cria_produto_controller.php" method="POST" enctype="multipart/form-data">
            <h1 class="h3 mb-3 fw-normal">Cadastrar Produto</h1>

            <div class="form-floating my-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="Nome" name="nome" required>
                <label for="floatingInput">Nome</label>
            </div>

            <div class="form-floating my-3">
                <input type="number" class="form-control" id="floatingInput" name="preco" step="0.01" required>
                <label for="floatingInput">Preço</label>
            </div>

            <div class="form-floating my-3">
                <input type="file" class="form-control" id="floatingInput" name="imagem">
                <label for="floatingInput">Imagem</label>
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit">Cadastrar</button>
        </form>
    </div>

</section>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/carrinho/templates/rodape.php';
?>