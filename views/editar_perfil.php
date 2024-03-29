<?php
if (isset($_COOKIE['msg'])){
    setcookie('msg', '', time() - 3600, '/carrinho/');
    setcookie('tipo', '', time() - 3600, '/carrinho/');
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/carrinho/templates/cabecalho.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/carrinho/models/usuario.php';

if (!isset($_SESSION['usuario'])) {
    header('Location: /carrinho/views/login.php');
    exit();
}

try {
    $usuario = new Usuario($_SESSION['usuario']['id']);
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
<?php endif; ?>

<section class="d-flex align-items-center py-4">
    <div class="form-signin col-8 col-lg-4 m-auto">
        <form action="/carrinho/controllers/edita_usuario_controller.php" method="POST" enctype="multipart/form-data">
            <h1 class="h3 mb-3 fw-normal">Editar Perfil</h1>

            <div class="form-floating my-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="Seu Nome" name="nome" value="<?= $usuario->nome_usuario ?>" required>
                <label for="floatingInput">Nome</label>
            </div>

            <div class="form-floating my-3">
                <input type="email" class="form-control" id="floatingInput" placeholder="nome@exemplo.com" name="email" value="<?= $usuario->email ?>" required>
                <label for="floatingInput">Email</label>
            </div>

            <div class="form-floating my-3">
                <input type="file" class="form-control" id="floatingInput" name="imagem">
                <label for="floatingInput">Imagem</label>
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit">Atualizar</button>
        </form>
    </div>

</section>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/carrinho/templates/rodape.php';
?>