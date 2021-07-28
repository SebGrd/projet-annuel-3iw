<header id="header" class="header">
    <div class="container">
        <div class="header__wrapper">
            <div class="header__title">
                <a href="/" class="header__title__logo">
                    <img src="public/img/logo.png" alt="logo site" class="header__title__logo__img">
                </a>
                <a href="/" class="header__title__name">Restaurant</a>
            </div>
            <div class="header__menu">
                <button class="header__menu__burger" id="burger-btn">
                    <svg id="burger-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                         width="24px"
                         fill="#000000">
                        <path d="M0 0h24v24H0V0z" fill="none"/>
                        <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/>
                    </svg>
                    <svg id="burger-icon-opened" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"
                         height="24px"
                         viewBox="0 0 24 24" width="24px" fill="#000000">
                        <path d="M0,0h24v24H0V0z" fill="none"/>
                        <path d="M3,18h13v-2H3V18z M3,13h10v-2H3V13z M3,6v2h13V6H3z M21,15.59L17.42,12L21,8.41L19.59,7l-5,5l5,5L21,15.59z"/>
                    </svg>
                </button>
                <nav class="header__menu__nav" id="header-nav">
                    <ul class="header__menu__nav__list">
                        <li class="header__menu__nav__list__item">
                            <a href="/products" class="header__menu__nav__list__item__link">Nos produits</a>
                        </li>
                        <li class="header__menu__nav__list__item">
                            <a href="/restaurant" class="header__menu__nav__list__item__link">Le restaurant</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="header__cart">
                <button class="header__cart__button" id="cart-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                         fill="#000000">
                        <path d="M0 0h24v24H0V0z" fill="none"/>
                        <path d="M15.55 13c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.37-.66-.11-1.48-.87-1.48H5.21l-.94-2H1v2h2l3.6 7.59-1.35 2.44C4.52 15.37 5.48 17 7 17h12v-2H7l1.1-2h7.45zM6.16 6h12.15l-2.76 5H8.53L6.16 6zM7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/>
                    </svg>
                </button>
                <div class="header__cart__cart header__cart__cart--hidden" id="cart">
                    <span class="header__cart__cart__title">Panier</span>
                    <ul class="header__cart__cart__list" id="cart-list">
                        <li class="header__cart__cart__list__item">
                            <span>Le panier est vide.</span>
                        </li>
                    </ul>
                    <hr>
                    <div class="header__cart__cart__total">
                        <span class="header__cart__cart__total__title">Total:</span>
                        <span class="header__cart__cart__total__price" id="cart-total">0€</span>
                    </div>
                    <form class="header__cart__cart__form" action="/order" method="post" id="cart-form">
                        <input type="hidden" id="cart-form-input" name="products">
                        <button class="header__cart__cart__form__button" type="submit">Commander</button>
                    </form>
                </div>
            </div>
            <div class="header__profile">
                <!--            <a href="/login" class="header__profile__login">Se connecter</a>-->
                <button class="header__profile__button" id="profile-menu-button">
                    <img src="https://picsum.photos/64/64" class="header__profile__button__picture"
                         alt="logged profile picture">
                </button>
                <div class="header__profile__menu header__profile__menu--hidden" id="profile-menu">
                    <ul class="header__profile__menu__list">
                        <?php if (!$_S::isConnected()): ?>
                            <li class="header__profile__menu__list__item">
                                <a class="header__profile__menu__list__item__link" href="/login">Se connecter</a>
                            </li>
                            
                            <li class="header__profile__menu__list__item">
                                <a class="header__profile__menu__list__item__link" href="/register">S'inscrire</a>
                            </li>
                        <?php endif; ?>

                        <?php if ($_S::isAdmin()): ?>
                            <li class="header__profile__menu__list__item">
                                <a class="header__profile__menu__list__item__link" href="/admin">Tableau de bord</a>
                            </li>
                        <?php endif; ?>

                        <?php if ($_S::isConnected()): ?>
                            <li class="header__profile__menu__list__item">
                                <a class="header__profile__menu__list__item__link" href="<?= $_S::isAdmin() ? '/admin' : '' ?>/profile">Mon profil</a>
                            </li>

                            <li class="header__profile__menu__list__item">
                                <a class="header__profile__menu__list__item__link header__profile__menu__list__item__link--danger" href="/logout">Déconnexion</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
<?php if ($_S::isAdmin() && explode('?', $_R::getCurrentRoute())[0] === '/page'): ?>
    <li class="menu-main-item">
        <a href="/admin<?= $_R::getCurrentRoute() ?>" class="menu-main-item-link">Modifier</a>
    </li>
<?php endif; ?>