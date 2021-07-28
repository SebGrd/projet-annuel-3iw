<section class="banner banner--app">
    <img class="banner__img" src="public/img/banner.webp" alt="">
</section>

<section class="invoice">
    <div class="container">
        <h1>Commande confirmée</h1>
        <p>Votre commande d'un montant de <b><?= $order->getTotal_price()?>€</b> a bien été prise en compte.</p>
        <h3>Details de facturation</h3>
        <table>
            <thead>
            <tr>
                <th colspan="2">Addresse</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Nom</td>
                <td><?= $address->getName()?></td>
            </tr>
            <tr>
                <td>Addresse</td>
                <td><?= $address->getAddress()?></td>
            </tr>
            <tr>
                <td>Complément d'addresse</td>
                <td><?= $address->getAddress2()?></td>
            </tr>
            <tr>
                <td>Région</td>
                <td><?= $address->getDistrict()?></td>
            </tr>
            <tr>
                <td>Ville</td>
                <td><?= $address->getCity()?></td>
            </tr>
            <tr>
                <td>Code postal</td>
                <td><?= $address->getPostal_code()?></td>
            </tr>
            <tr>
                <td>Téléphone</td>
                <td><?= $address->getPhone()?></td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td class="gray total">Total</td>
                <td><?= $order->getTotal_price() ?>€</td>
            </tr>
            </tbody>
        </table>
    </div>
</section>

<!-- Show messages -->
<?= $_::render('incl.message', ['msgs' => ['login_success'], 'errs' => $errors ?? []]); ?>
