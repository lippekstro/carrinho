<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/carrinho/templates/cabecalho.php';
?>


<section class="d-flex align-items-center py-4">
    <div class="form-signin w-25 m-auto">
        <?php if (isset($_COOKIE['erro'])) : ?>
            <p class="text-danger text-center"><?= $_COOKIE['erro'] ?></p>
            <?php setcookie('erro', '', time() - 3600, '/') ?>
        <?php endif; ?>
        <form action="/carrinho/controllers/login_controller.php" method="POST">
            <h1 class="h3 mb-3 fw-normal">Login</h1>

            <div class="form-floating my-3">
                <input type="email" class="form-control" id="floatingInput" placeholder="nome@exemplo.com" name="email">
                <label for="floatingInput">Email</label>
            </div>
            <div class="form-floating my-3">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Senha" name="senha">
                <label for="floatingPassword">Senha</label>
            </div>

            <div class="text-center">
                <a href="/carrinho/views/cadastro.php">Cadastrar-se</a>
            </div>


            <div class="form-check text-start my-3">
                <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Lembrar
                </label>
            </div>
            <button class="btn btn-primary w-100 py-2" type="submit">Entrar</button>
        </form>
    </div>

</section>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/carrinho/templates/rodape.php';
?>