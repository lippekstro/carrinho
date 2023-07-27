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
    $categorias = Categoria::listar();
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>

<section>
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
</section>

<section class="d-flex justify-content-center m-5">
    <table class="table table-hover col col-lg-12">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col" colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categorias as $c) : ?>
                <tr>
                    <td class="col-2"><?= $c['nome_categoria'] ?></td>
                    <td class="col-2"><a href="/carrinho/views/admin/editar_categoria.php?id=<?= $c['id_categoria'] ?>">Editar</a></td>
                    <td class="col-2"><a href="/carrinho/controllers/deleta_categoria_controller.php?id=<?= $c['id_categoria'] ?>">Deletar</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
</section>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/carrinho/templates/rodape.php';
?>