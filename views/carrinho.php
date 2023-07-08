<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/carrinho/templates/cabecalho.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/carrinho/models/produto.php';

if (isset($_COOKIE['carrinho'])) {
    $carrinho = unserialize($_COOKIE['carrinho']);

    $produtos = array();

    foreach ($carrinho as $item) {
        $produto = new Produto($item['id_produto']);
        $produto->quantidade = $item['quantidade'];
        $produtos[] = $produto;
    }
}

$total = 0;
?>

<?php if (!isset($_COOKIE['carrinho'])) : ?>
    <div class="d-flex justify-content-center m-3">
        <p>Nenhum Item no Carrinho</p>
    </div>
<?php else : ?>
    <div class="container">
        <main>
            <div class="py-5 text-center">
                <i class="bi bi-cart-check-fill fs-1"></i>
                <h2>Finalize a Compra</h2>
            </div>

            <div class="row g-5">
                <div class="col-md-5 col-lg-4 order-md-last">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-primary">Seu Carrinho</span>
                        <span class="badge bg-primary rounded-pill"><?= $qtd ?></span>
                    </h4>
                    <ul class="list-group mb-3">
                        <?php foreach ($produtos as $p => $i) : ?>
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div>
                                    <h6 class="my-0"><?= $i->nome_produto ?> x <?= $i->quantidade ?></h6>
                                </div>
                                <span class="text-body-secondary"><?= $i->preco * $i->quantidade ?>R$</span>
                            </li>
                            <?php $total += $i->preco * $i->quantidade ?>
                        <?php endforeach; ?>

                        <!-- <li class="list-group-item d-flex justify-content-between bg-body-tertiary">
                            <div class="text-success">
                                <h6 class="my-0">Promo code</h6>
                                <small>EXAMPLECODE</small>
                            </div>
                            <span class="text-success">−$5</span>
                        </li> -->
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total</span>
                            <strong><?= $total ?>R$</strong>
                        </li>
                    </ul>

                    <form class="card p-2">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Promo code">
                            <button type="submit" class="btn btn-secondary">Resgatar</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3">Endereço de Cobrança</h4>
                    <form action="/carrinho/views/final.php" class="needs-validation" novalidate>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="firstName" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
                                <div class="invalid-feedback">
                                    Nome é obrigatório.
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="lastName" class="form-label">Sobrenome</label>
                                <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
                                <div class="invalid-feedback">
                                    Sobrenome é obrigatório.
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <label for="email" class="form-label">Email </label>
                                <input type="email" class="form-control" id="email" placeholder="voce@exemplo.com">
                                <div class="invalid-feedback">
                                    Por favor entre um endereço de email válido
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-3">
                                <label for="zip" class="form-label">CEP</label>
                                <input type="text" class="form-control" id="zip" placeholder="12345678" maxlength="8" required>
                                <div class="invalid-feedback">
                                    CEP é obrigatório.
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <label for="logradouro" class="form-label">Endereço</label>
                                <input type="text" class="form-control" id="logradouro" placeholder="Rua Principal, 10" required>
                                <div class="invalid-feedback">
                                    Por favor escreva seu endereço de entrega.
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-3">
                                <label for="numero" class="form-label">Numero</label>
                                <input type="text" class="form-control" id="numero" placeholder="S/N" required>
                            </div>

                            <div class="col-sm-12 col-md-9">
                                <label for="cidade" class="form-label">Cidade</label>
                                <input type="text" class="form-control" id="cidade" placeholder="Sao Luis" required>
                                <div class="invalid-feedback">
                                    Por favor escreva seu bairro de entrega.
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-3">
                                <label for="bairro" class="form-label">Bairro</label>
                                <input type="text" class="form-control" id="bairro" placeholder="Centro" required>
                                <div class="invalid-feedback">
                                    Por favor escreva seu bairro de entrega.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="address2" class="form-label">Endereço 2 <span class="text-body-secondary">(Optional)</span></label>
                                <input type="text" class="form-control" id="address2" placeholder="Apartamento ou suite">
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="same-address">
                            <label class="form-check-label" for="same-address">Endereço de entrega é o mesmo endereço de cobrança</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="save-info">
                            <label class="form-check-label" for="save-info">Salve esta informação para próxima compra</label>
                        </div>

                        <hr class="my-4">

                        <h4 class="mb-3">Pagamento</h4>

                        <div class="my-3">
                            <div class="form-check">
                                <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked="" required>
                                <label class="form-check-label" for="credit">Credito</label>
                            </div>
                            <div class="form-check">
                                <input id="debit" name="paymentMethod" type="radio" class="form-check-input" required>
                                <label class="form-check-label" for="debit">Debito</label>
                            </div>
                            <div class="form-check">
                                <input id="pix" name="paymentMethod" type="radio" class="form-check-input" required>
                                <label class="form-check-label" for="pix">Pix</label>
                            </div>
                        </div>

                        <div class="row gy-3">
                            <div class="col-md-6">
                                <label for="cc-name" class="form-label">Nome no Cartão</label>
                                <input type="text" class="form-control" id="cc-name" placeholder="" required>
                                <small class="text-body-secondary">Nome como exibido no cartão</small>
                                <div class="invalid-feedback">
                                    Name no cartão é obrigatório.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="cc-number" class="form-label">Número do Cartão de Crédito</label>
                                <input type="text" class="form-control" id="cc-number" placeholder="" required>
                                <div class="invalid-feedback">
                                    Número do Cartão de Crédito é obrigatório.
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="cc-expiration" class="form-label">Validade do Cartão</label>
                                <input type="month" class="form-control" id="cc-expiration" placeholder="" required>
                                <div class="invalid-feedback">
                                    Validade do Cartão é obrigatório.
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="cc-cvv" class="form-label">CVV</label>
                                <input type="text" class="form-control" id="cc-cvv" maxlength="3" placeholder="" required>
                                <div class="invalid-feedback">
                                    CVV é obrigatório.
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <button class="w-100 btn btn-primary btn-lg" type="submit">Finalizar</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
<?php endif; ?>

<?php if (isset($_COOKIE['carrinho'])) : ?>
    <script src="/carrinho/js/viacep.js"></script>
<?php endif; ?>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/carrinho/templates/rodape.php';
?>