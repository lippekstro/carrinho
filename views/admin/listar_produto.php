<?php
if (isset($_COOKIE['msg'])){
    setcookie('msg', '', time() - 3600, '/carrinho/');
    setcookie('tipo', '', time() - 3600, '/carrinho/');
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/carrinho/templates/cabecalho.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/carrinho/models/produto.php';

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['nv_acesso'] < 2) {
    setcookie('msg', 'Você não tem permissão para acessar este conteúdo', time() + 3600, '/carrinho/');
    setcookie('tipo', 'perigo', time() + 3600, '/carrinho/');
    header('Location: /carrinho/index.php');
    exit();
}

try {
    $produtos = Produto::listar();
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
    <?php endif; ?>
</section>

<section class="d-flex justify-content-center m-5">
    <table class="table table-hover col col-lg-12">
        <thead>
            <tr>
                <th scope="col">Imagens</th>
                <th scope="col">Nome</th>
                <th scope="col">Categoria</th>
                <th scope="col">Preço</th>
                <th scope="col" colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produtos as $p) : ?>
                <tr>
                    <td class="col-4"><img src="data:image/jpg;charset=utf8;base64,<?= base64_encode($p['img_produto']); ?>" class="col-12" alt="..."></td>
                    <td class="col-2"><?= $p['nome_produto'] ?></td>
                    <td class="col-2"><?= $p['nome_categoria'] ?></td>
                    <td class="col-2"><?= $p['preco'] ?>R$</td>
                    <td class="col-2"><a href="/carrinho/views/admin/editar_produto.php?id=<?= $p['id_produto'] ?>">Editar</a></td>
                    <td class="col-2"><a href="/carrinho/controllers/deleta_produto_controller.php?id=<?= $p['id_produto'] ?>">Deletar</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
</section>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/carrinho/templates/rodape.php';
?>