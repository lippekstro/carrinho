<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/carrinho/templates/cabecalho.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/carrinho/models/categoria.php';

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['nv_acesso'] < 2) {
    setcookie('msg', 'Você não tem permissão para acessar este conteúdo', time() + 3600, '/carrinho/');
    setcookie('tipo', 'perigo', time() + 3600, '/carrinho/');
    header('Location: /carrinho/index.php');
    exit();
}

try {
    $categoria = new Categoria($_GET['id']);
} catch (Exception $e) {
    echo $e->getMessage();
}
?>

<section class="d-flex align-items-center py-4">
    <div class="form-signin col-8 col-lg-4 m-auto">
        <form action="/carrinho/controllers/edita_categoria_controller.php" method="POST">
            <h1 class="h3 mb-3 fw-normal">Editar Categoria</h1>

            <input type="hidden" class="form-control" id="floatingInput" name="id" value="<?= $categoria->id_categoria ?>">

            <div class="form-floating my-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="Nome" name="nome" value="<?= $categoria->nome_categoria ?>" required>
                <label for="floatingInput">Nome</label>
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit">Editar</button>
        </form>
    </div>

</section>


<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/carrinho/templates/rodape.php';
?>