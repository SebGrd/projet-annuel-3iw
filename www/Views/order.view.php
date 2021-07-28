<section class="banner banner--app">
    <img class="banner__img" src="public/img/banner.webp" alt="">
</section>

<section class="invoice">
    <div class="container">
        <h1>Récapitulatif de votre commande</h1>
        <div class="invoice__steps">
            <ul class="invoice__steps__list">
                <li data-step="1"
                    class="invoice__steps__list__item invoice__steps__list__item--active invoice__steps__list__item--current">
                    Récapitulatif
                </li>
                <li data-step="2" class="invoice__steps__list__item ">Coordonnées</li>
                <li data-step="3" class="invoice__steps__list__item">Paiement</li>
            </ul>
        </div>
        <div class="invoice__step" data-step="1">
            <table>
                <thead>
                <tr>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Prix unitaire</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= $product['name'] ?></td>
                        <td><?= $product['product_quantity'] ?></td>
                        <td><?= $product['price'] ?>€</td>
                        <td><?= number_format($product['price'] * $product['product_quantity'], 2) ?>€</td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td class="gray total" colspan="3">Total</td>
                    <td><?= $order->getTotal_price() ?>€</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="invoice__step invoice__step--form invoice__step--hidden" data-step="2">
            <?php \App\Core\FormBuilder::render($formAddress); ?>
        </div>
        <div class="invoice__step invoice__step--hidden" data-step="3">
            <p class="invoice__step__total">Total TTC à payer:
                <span class="invoice__step__total__price">
                    <?= $order->getTotal_price() ?>€
                </span>
            </p>
            <button class="invoice__step__total__button">Virement
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#FFFFFF">
                    <path d="M0 0h24v24H0V0z" fill="none"/>
                    <path d="M6.5 10h-2v7h2v-7zm6 0h-2v7h2v-7zm8.5 9H2v2h19v-2zm-2.5-9h-2v7h2v-7zm-7-6.74L16.71 6H6.29l5.21-2.74m0-2.26L2 6v2h19V6l-9.5-5z"/>
                </svg>
            </button>
            <button class="invoice__step__total__button invoice__step__total__button--blue">Carte bancaire
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#FFFFFF">
                    <path d="M0 0h24v24H0V0z" fill="none"/>
                    <path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/>
                </svg>
            </button>
        </div>
        <div class="invoice__actions">
            <button class="invoice__actions__button" id="next-step">Suivant</button>
        </div>
    </div>
</section>

<!-- Show messages -->
<?= $_::render('incl.message', ['msgs' => ['login_success'], 'errs' => $errors ?? []]); ?>
