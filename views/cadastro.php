<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/carrinho/templates/cabecalho.php';
?>

<section class="d-flex align-items-center py-4">
    <div class="form-signin col-8 col-lg-4 m-auto">
        <form action="/carrinho/controllers/cria_usuario_controller.php" method="POST" enctype="multipart/form-data">
            <h1 class="h3 mb-3 fw-normal">Cadastre-se</h1>

            <div class="form-floating my-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="Seu Nome" name="nome" required>
                <label for="floatingInput">Nome</label>
            </div>

            <div class="form-floating my-3">
                <input type="email" class="form-control" id="floatingInput" placeholder="nome@exemplo.com" name="email" required>
                <label for="floatingInput">Email</label>
            </div>

            <div class="form-floating my-3">
                <input type="file" class="form-control" id="floatingInput" name="imagem">
                <label for="floatingInput">Imagem</label>
            </div>

            <div class="form-floating my-3">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Senha" name="senha" required>
                <label for="floatingPassword">Senha</label>
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit">Cadastrar</button>
        </form>
    </div>

</section>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/carrinho/templates/rodape.php';
?>