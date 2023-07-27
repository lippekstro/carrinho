<?php
setcookie('carrinho', '', time()-3600, '/carrinho/');

require_once $_SERVER['DOCUMENT_ROOT'] . '/carrinho/templates/cabecalho.php';

?>

<section class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <h1>Obrigado por sua compra.</h1>
    <p class="lead">Estamos processando seu pedido.</p>
</section>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/carrinho/templates/rodape.php';
?>