<?php
if (isset($_COOKIE['msg'])){
    setcookie('msg', '', time() - 3600, '/carrinho/');
    setcookie('tipo', '', time() - 3600, '/carrinho/');
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/carrinho/templates/cabecalho.php';

if (isset($_SESSION['usuario'])) {
    setcookie('msg', 'Você já está logado', time() + 3600, '/carrinho/');
    setcookie('tipo', 'info', time() + 3600, '/carrinho/');
    header('Location: /carrinho/index.php');
    exit();
}
?>


<section class="d-flex align-items-center py-4">
    <div class="form-signin col-8 col-lg-4 m-auto">
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
        
        <form action="/carrinho/controllers/login_controller.php" method="POST">
            <h1 class="h3 mb-3 fw-normal">Login</h1>

            <div class="form-floating my-3">
                <input type="email" class="form-control" id="floatingInput" placeholder="nome@exemplo.com" name="email" required>
                <label for="floatingInput">Email</label>
            </div>
            <div class="form-floating my-3">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Senha" name="senha" required>
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