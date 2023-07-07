<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/carrinho/templates/cabecalho.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/carrinho/models/produto.php';

try {
    $produtos = Produto::listar();
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>

<section>
    <?php if (isset($_COOKIE['sucesso'])) : ?>
        <p class="text-success text-center m-3"><?= $_COOKIE['sucesso'] ?></p>
        <?php setcookie('sucesso', '', time() - 3600, '/') ?>
    <?php endif; ?>
</section>

<section class="col col-lg-12">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Img</th>
                <th scope="col">Nome</th>
                <th scope="col">Preço</th>
                <th scope="col" colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produtos as $p) : ?>
                <tr>
                    <td class="col-4"><img src="data:image/jpg;charset=utf8;base64,<?= base64_encode($p['img_produto']); ?>" class="col-12" alt="..."></td>
                    <td class="col-2"><?= $p['nome_produto'] ?></td>
                    <td class="col-2"><?= $p['preco'] ?></td>
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