<section class="banner banner--app">
    <img class="banner__img" src="public/img/banner.webp" alt="">
</section>
<?php
var_dump($products);
var_dump($menus);
?>
<section class="app">
    <div class="container">
        <div class="row">
            <div class="col-5">
                <aside class="app__sidemenu">
                    <ul class="app__sidemenu__list">
                        <?php if (!empty($menus)) :?>
                            <?php foreach ($menus as $key => $menu): ?>
                                <li class="app__sidemenu__list__item">
                                    <button class="app__sidemenu__list__item__button <?= ($key === 0) ? 'app__sidemenu__list__item__button--active' : '' ?>"
                                            data-id="<?= $menu->getId() ?>"><?= $menu->getTitle() ?>
                                    </button>
                                </li>
                            <?php endforeach; ?>
                        <?php else:?>
                            <li class="app__sidemenu__list__item">
                                <p>Pas de catégorie</p>
                            </li>
                        <?php endif;?>
                    </ul>
                </aside>
            </div>
            <div class="col-19">
                <section class="app__products">
                    <ul class="app__products__list" data-id="1">
                        <li class="app__products__list__item">
                            <article class="featured__card">
                                <div class="featured__card__picture">
                                    <img class="featured__card__picture__img"
                                         src="images/plat3.webp"
                                         alt="">
                                </div>
                                <h1 class="featured__card__title">Picèe de boeuf sauve au vin</h1>
                                <footer class="featured__card__footer">
                                    <span class="featured__card__footer__price">16.50€</span>
                                    <button class="featured__card__footer__cart"
                                            data-productname="Picèe de boeuf sauve au vin"
                                            data-productPrice="16.50"
                                            data-productId="0">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                             width="24px"
                                             fill="#000000">
                                            <path d="M0 0h24v24H0V0z" fill="none"/>
                                            <path d="M11 9h2V6h3V4h-3V1h-2v3H8v2h3v3zm-4 9c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2zm-8.9-5h7.45c.75 0 1.41-.41 1.75-1.03l3.86-7.01L19.42 4l-3.87 7H8.53L4.27 2H1v2h2l3.6 7.59-1.35 2.44C4.52 15.37 5.48 17 7 17h12v-2H7l1.1-2z"/>
                                        </svg>
                                    </button>
                                </footer>
                            </article>
                        </li>
                        <li class="app__products__list__item">
                            <article class="featured__card">
                                <div class="featured__card__picture">
                                    <img class="featured__card__picture__img"
                                         src="images/plat1.webp"
                                         alt="">
                                </div>
                                <h1 class="featured__card__title">Merlu sauce poivre</h1>
                                <footer class="featured__card__footer">
                                    <span class="featured__card__footer__price">16.50€</span>
                                    <button class="featured__card__footer__cart"
                                            data-productname="Merlu sauce poivre"
                                            data-productPrice="16.50"
                                            data-productId="2">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                             width="24px"
                                             fill="#000000">
                                            <path d="M0 0h24v24H0V0z" fill="none"/>
                                            <path d="M11 9h2V6h3V4h-3V1h-2v3H8v2h3v3zm-4 9c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2zm-8.9-5h7.45c.75 0 1.41-.41 1.75-1.03l3.86-7.01L19.42 4l-3.87 7H8.53L4.27 2H1v2h2l3.6 7.59-1.35 2.44C4.52 15.37 5.48 17 7 17h12v-2H7l1.1-2z"/>
                                        </svg>
                                    </button>
                                </footer>
                            </article>
                        </li>
                    </ul>
                    <ul class="app__products__list app__products__list--hidden" data-id="2">
                        <li class="app__products__list__item">
                            <article class="featured__card">
                                <div class="featured__card__picture">
                                    <img class="featured__card__picture__img"
                                         src="images/plat1.webp"
                                         alt="">
                                </div>
                                <h1 class="featured__card__title">Merlu sauce poivre</h1>
                                <footer class="featured__card__footer">
                                    <span class="featured__card__footer__price">16.50€</span>
                                    <button class="featured__card__footer__cart"
                                            data-productname="Merlu sauce poivre"
                                            data-productPrice="16.50"
                                            data-productId="1">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                             width="24px"
                                             fill="#000000">
                                            <path d="M0 0h24v24H0V0z" fill="none"/>
                                            <path d="M11 9h2V6h3V4h-3V1h-2v3H8v2h3v3zm-4 9c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2zm-8.9-5h7.45c.75 0 1.41-.41 1.75-1.03l3.86-7.01L19.42 4l-3.87 7H8.53L4.27 2H1v2h2l3.6 7.59-1.35 2.44C4.52 15.37 5.48 17 7 17h12v-2H7l1.1-2z"/>
                                        </svg>
                                    </button>
                                </footer>
                            </article>
                        </li>
                    </ul>
                    <ul class="app__products__list app__products__list--hidden" data-id="3">
                        <li class="app__products__list__item">
                            <article class="featured__card">
                                <div class="featured__card__picture">
                                    <img class="featured__card__picture__img"
                                         src="images/plat2.webp"
                                         alt="">
                                </div>
                                <h1 class="featured__card__title">Porc avec ses pommes de terre sautés</h1>
                                <footer class="featured__card__footer">
                                    <span class="featured__card__footer__price">16.50€</span>
                                    <button class="featured__card__footer__cart"
                                            data-productname="Porc avec ses pommes de terre sautés"
                                            data-productPrice="16.50"
                                            data-productId="3">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                             width="24px"
                                             fill="#000000">
                                            <path d="M0 0h24v24H0V0z" fill="none"/>
                                            <path d="M11 9h2V6h3V4h-3V1h-2v3H8v2h3v3zm-4 9c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2zm-8.9-5h7.45c.75 0 1.41-.41 1.75-1.03l3.86-7.01L19.42 4l-3.87 7H8.53L4.27 2H1v2h2l3.6 7.59-1.35 2.44C4.52 15.37 5.48 17 7 17h12v-2H7l1.1-2z"/>
                                        </svg>
                                    </button>
                                </footer>
                            </article>
                        </li>
                        <li class="app__products__list__item">
                            <article class="featured__card">
                                <div class="featured__card__picture">
                                    <img class="featured__card__picture__img"
                                         src="images/plat3.webp"
                                         alt="">
                                </div>
                                <h1 class="featured__card__title">Picèe de boeuf sauve au vin</h1>
                                <footer class="featured__card__footer">
                                    <span class="featured__card__footer__price">16.50€</span>
                                    <button class="featured__card__footer__cart"
                                            data-productname="Picèe de boeuf sauve au vin"
                                            data-productPrice="16.50"
                                            data-productId="4">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                             width="24px"
                                             fill="#000000">
                                            <path d="M0 0h24v24H0V0z" fill="none"/>
                                            <path d="M11 9h2V6h3V4h-3V1h-2v3H8v2h3v3zm-4 9c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2zm-8.9-5h7.45c.75 0 1.41-.41 1.75-1.03l3.86-7.01L19.42 4l-3.87 7H8.53L4.27 2H1v2h2l3.6 7.59-1.35 2.44C4.52 15.37 5.48 17 7 17h12v-2H7l1.1-2z"/>
                                        </svg>
                                    </button>
                                </footer>
                            </article>
                        </li>
                        <li class="app__products__list__item">
                            <article class="featured__card">
                                <div class="featured__card__picture">
                                    <img class="featured__card__picture__img"
                                         src="images/plat1.webp"
                                         alt="">
                                </div>
                                <h1 class="featured__card__title">Merlu sauce poivre</h1>
                                <footer class="featured__card__footer">
                                    <span class="featured__card__footer__price">16.50€</span>
                                    <button class="featured__card__footer__cart"
                                            data-productname="Merlu sauce poivre" data-productPrice="16.50"
                                            data-productId="5">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                             width="24px"
                                             fill="#000000">
                                            <path d="M0 0h24v24H0V0z" fill="none"/>
                                            <path d="M11 9h2V6h3V4h-3V1h-2v3H8v2h3v3zm-4 9c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2zm-8.9-5h7.45c.75 0 1.41-.41 1.75-1.03l3.86-7.01L19.42 4l-3.87 7H8.53L4.27 2H1v2h2l3.6 7.59-1.35 2.44C4.52 15.37 5.48 17 7 17h12v-2H7l1.1-2z"/>
                                        </svg>
                                    </button>
                                </footer>
                            </article>
                        </li>
                    </ul>
                    <ul class="app__products__list app__products__list--hidden" data-id="4">
                        <li class="app__products__list__item">
                            <p>Pas de produits dans cette catégorie.</p>
                        </li>
                    </ul>
                    <ul class="app__products__list app__products__list--hidden" data-id="5">
                        <li class="app__products__list__item">
                            <article class="featured__card">
                                <div class="featured__card__picture">
                                    <img class="featured__card__picture__img"
                                         src="images/plat1.webp"
                                         alt="">
                                </div>
                                <h1 class="featured__card__title">Merlu sauce poivre</h1>
                                <footer class="featured__card__footer">
                                    <span class="featured__card__footer__price">16.50€</span>
                                    <button class="featured__card__footer__cart"
                                            data-productname="Merlu sauce poivre" data-productPrice="16.50"
                                            data-productid="7">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                             width="24px"
                                             fill="#000000">
                                            <path d="M0 0h24v24H0V0z" fill="none"/>
                                            <path d="M11 9h2V6h3V4h-3V1h-2v3H8v2h3v3zm-4 9c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2zm-8.9-5h7.45c.75 0 1.41-.41 1.75-1.03l3.86-7.01L19.42 4l-3.87 7H8.53L4.27 2H1v2h2l3.6 7.59-1.35 2.44C4.52 15.37 5.48 17 7 17h12v-2H7l1.1-2z"/>
                                        </svg>
                                    </button>
                                </footer>
                            </article>
                        </li>
                    </ul>
                </section>
            </div>
        </div>
    </div>
</section>