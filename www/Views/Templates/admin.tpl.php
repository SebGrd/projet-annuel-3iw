<!DOCTYPE html>
<html lang="fr">

<head>
    <?= $_::render('incl.style'); ?>
	<?= $_::render('incl.scripts'); ?>
    <title><?= $_SESSION['title'] ?></title>
</head>

<body>
    <header class="header" id="header">
        <section class="header__title mr-1">
            <a href="/admin">
                <h1>Admin</h1>
            </a>
        </section>

        <section class="header__search">
            <div class="header__search__input">
                <svg class="header__search__input__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white"
                    width="18px" height="18px">
                    <path d="M0 0h24v24H0z" fill="none"/>
                    <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                </svg>

                <input class="header__search__input__input" type="text" placeholder="Search">
            </div>
        </section>

        <section class="header__menu">
            <ul class="header__menu__list">
                <li class="header__menu__list__item header__menu__list__item--notifications">
                    <button class="pp-btn rtl header__menu__list__item--notifications__button">
                        <svg class="header__menu__list__item--notifications__button__icon"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="18px" height="18px">
                            <path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.89 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z"/>
                        </svg>
                        
                        <!-- <ul class="header__menu__popup-menu text-center" id="pp-menu-1"> -->
                        <ul class="pp-menu relative bg-light w-max r-0 p-1 brd-8 box-shadow ov-h list-none text-center">
                            <!-- Show messages -->
                            
                            <?php
                                $msgs = array_filter($_SESSION, function($key) {
                                    return \App\Core\Helpers::str_contains($key, 'success') || \App\Core\Helpers::str_contains($key, 'error');
                                }, ARRAY_FILTER_USE_KEY);
                                $msgs = array_keys($msgs);
                            ?>
        
                            <?= $_::render('incl.notifications', ['msgs' => $msgs ?? [], 'errs' => $errors ?? []]) ?>
                        </ul>
                    </button>
                </li>

                <li class="header__menu__list__item header__menu__list__item--separator"></li>
            
                <li class="header__menu__list__item header__menu__list__item--profile">
                    <span class="header__menu__list__item--profile__name">
                        <?= ucfirst($user->firstname) ?? '' ?>
                    </span>
                    
                    <figure class="pp-btn rtl header__menu__list__item--profile__picture">
                        <img src=<?= $user->avatar !== null ? 'http://' . $_SERVER['HTTP_HOST'] . '/'. \App\Core\Helpers::getImageUrl($user->getAvatar()) : 'https://picsum.photos/100/100.jpg' ?> />
                        
                        <ul class="pp-menu relative bg-light w-max r-0 p-1 brd-8 box-shadow ov-h list-none text-center">
                            <li class="header__menu__popup-menu__item">
                                <a href="/admin/profile" class="header__menu__popup-menu__item__link">
                                    Mon profil
                                </a>
                            </li>

                            <li class="header__menu__popup-menu__item">
                                <a href="/logout" class="header__menu__popup-menu__item__link header__menu__popup-menu__item__link--danger">
                                    Déconnexion
                                </a>
                            </li>
                        </ul>
                    </figure>
                </li>
            </ul>

            </section>
    </header>

    <div class="page-wrapper">
        <aside class="menu y-scroll-auto">
            <section class="menu__section">
                <ul class="menu__section__list">
                    <!--Voir le site -->
                    <li class="menu__section__list__item">
                        <a href="/" class="menu__section__list__item__link">
                            <span class="menu__section__list__item__icon">
                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    viewBox="0 0 27.02 27.02" style="enable-background:new 0 0 27.02 27.02;" xml:space="preserve">
                                    <path d="M3.674,24.876c0,0-0.024,0.604,0.566,0.604c0.734,0,6.811-0.008,6.811-0.008l0.01-5.581
                                        c0,0-0.096-0.92,0.797-0.92h2.826c1.056,0,0.991,0.92,0.991,0.92l-0.012,5.563c0,0,5.762,0,6.667,0
                                        c0.749,0,0.715-0.752,0.715-0.752V14.413l-9.396-8.358l-9.975,8.358C3.674,14.413,3.674,24.876,3.674,24.876z"/>
                                    <path d="M0,13.635c0,0,0.847,1.561,2.694,0l11.038-9.338l10.349,9.28c2.138,1.542,2.939,0,2.939,0
                                        L13.732,1.54L0,13.635z"/>
                                    <polygon points="23.83,4.275 21.168,4.275 21.179,7.503 23.83,9.752 	"/>
                                </svg>
                            </span>
                            <span class="menu__section__list__item__text">Voir le site</span>
                        </a>
                    </li>
                    
                    <!-- Vue d'ensemble -->
                    <li class="menu__section__list__item">
                        <a href="/admin" class="menu__section__list__item__link">
                            <span class="menu__section__list__item__icon">
                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                    <path d="M176.792,0H59.208C26.561,0,0,26.561,0,59.208v117.584C0,209.439,26.561,236,59.208,236h117.584
                                        C209.439,236,236,209.439,236,176.792V59.208C236,26.561,209.439,0,176.792,0z M196,176.792c0,10.591-8.617,19.208-19.208,19.208
                                        H59.208C48.617,196,40,187.383,40,176.792V59.208C40,48.617,48.617,40,59.208,40h117.584C187.383,40,196,48.617,196,59.208
                                        V176.792z"/>
                                    <path d="M452,0H336c-33.084,0-60,26.916-60,60v116c0,33.084,26.916,60,60,60h116c33.084,0,60-26.916,60-60V60
                                        C512,26.916,485.084,0,452,0z M472,176c0,11.028-8.972,20-20,20H336c-11.028,0-20-8.972-20-20V60c0-11.028,8.972-20,20-20h116
                                        c11.028,0,20,8.972,20,20V176z"/>
                                    <path d="M176.792,276H59.208C26.561,276,0,302.561,0,335.208v117.584C0,485.439,26.561,512,59.208,512h117.584
                                        C209.439,512,236,485.439,236,452.792V335.208C236,302.561,209.439,276,176.792,276z M196,452.792
                                        c0,10.591-8.617,19.208-19.208,19.208H59.208C48.617,472,40,463.383,40,452.792V335.208C40,324.617,48.617,316,59.208,316h117.584
                                        c10.591,0,19.208,8.617,19.208,19.208V452.792z"/>
                                    <path d="M452,276H336c-33.084,0-60,26.916-60,60v116c0,33.084,26.916,60,60,60h116c33.084,0,60-26.916,60-60V336
                                        C512,302.916,485.084,276,452,276z M472,452c0,11.028-8.972,20-20,20H336c-11.028,0-20-8.972-20-20V336c0-11.028,8.972-20,20-20
                                        h116c11.028,0,20,8.972,20,20V452z"/>
                                </svg>
                            </span>
                            <span class="menu__section__list__item__text">Vue d'ensemble</span>
                        </a>
                    </li>
                </ul>
            </section>

            <section class="menu__section">
                <span class="menu__section__title">Contenu</span>

                <ul class="menu__section__list">
                    <!-- Pages -->
                    <li class="menu__section__list__item">
                        <a href="/admin/pages" class="menu__section__list__item__link">
                            <span class="menu__section__list__item__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="18px" height="18px">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path d="M6 2c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6H6zm7 7V3.5L18.5 9H13z" />
                                </svg>
                            </span>
                            <span class="menu__section__list__item__text">Pages</span>
                        </a>
                    </li>

                    <!-- Produits -->
                    <li class="menu__section__list__item">
                        <a href="/admin/products" class="menu__section__list__item__link">
                            <span class="menu__section__list__item__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="18px" height="18px">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path d="M18.06 22.99h1.66c.84 0 1.53-.64 1.63-1.46L23 5.05h-5V1h-1.97v4.05h-4.97l.3 2.34c1.71.47 3.31 1.32 4.27 2.26 1.44 1.42 2.43 2.89 2.43 5.29v8.05zM1 21.99V21h15.03v.99c0 .55-.45 1-1.01 1H2.01c-.56 0-1.01-.45-1.01-1zm15.03-7c0-8-15.03-8-15.03 0h15.03zM1.02 17h15v2h-15z" />
                                </svg>
                            </span>
                            <span class="menu__section__list__item__text">Produits</span>
                        </a>
                    </li>

                    <!-- Menus -->
                    <li class="menu__section__list__item">
                        <a href="/admin/menus" class="menu__section__list__item__link">
                            <span class="menu__section__list__item__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="18px" height="18px">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path d="M19 5v14H5V5h14m1.1-2H3.9c-.5 0-.9.4-.9.9v16.2c0 .4.4.9.9.9h16.2c.4 0 .9-.5.9-.9V3.9c0-.5-.5-.9-.9-.9zM11 7h6v2h-6V7zm0 4h6v2h-6v-2zm0 4h6v2h-6zM7 7h2v2H7zm0 4h2v2H7zm0 4h2v2H7z" />
                                </svg>
                            </span>
                            <span class="menu__section__list__item__text">Menus</span>
                        </a>
                    </li>
                
                    <!-- Commandes -->
                    <li class="menu__section__list__item">
                        <a href="/admin/orders" class="menu__section__list__item__link">
                            <span class="menu__section__list__item__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="18px" height="18px">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z" />
                                </svg>
                            </span>
                            <span class="menu__section__list__item__text">Commandes</span>
                        </a>
                    </li>
                </ul>
            </section>

            <section class="menu__section">
                <span class="menu__section__title">Data</span>
                <ul class="menu__section__list">
                    <!-- Statistiques -->
                    <li class="menu__section__list__item">
                        <a href="" class="menu__section__list__item__link">
                            <span class="menu__section__list__item__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="black" width="18px" height="18px">
                                    <g>
                                        <rect fill="none" height="24" width="24" />
                                    </g>
                                    <g>
                                        <g>
                                            <g>
                                                <path d="M23,8c0,1.1-0.9,2-2,2c-0.18,0-0.35-0.02-0.51-0.07l-3.56,3.55C16.98,13.64,17,13.82,17,14c0,1.1-0.9,2-2,2s-2-0.9-2-2 c0-0.18,0.02-0.36,0.07-0.52l-2.55-2.55C10.36,10.98,10.18,11,10,11s-0.36-0.02-0.52-0.07l-4.55,4.56C4.98,15.65,5,15.82,5,16 c0,1.1-0.9,2-2,2s-2-0.9-2-2s0.9-2,2-2c0.18,0,0.35,0.02,0.51,0.07l4.56-4.55C8.02,9.36,8,9.18,8,9c0-1.1,0.9-2,2-2s2,0.9,2,2 c0,0.18-0.02,0.36-0.07,0.52l2.55,2.55C14.64,12.02,14.82,12,15,12s0.36,0.02,0.52,0.07l3.55-3.56C19.02,8.35,19,8.18,19,8 c0-1.1,0.9-2,2-2S23,6.9,23,8z" />
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </span>
                            <span class="menu__section__list__item__text">Statistiques</span>
                        </a>
                    </li>

                    <!-- Utilisateurs -->
                    <li class="menu__section__list__item">
                        <a href="/admin/users" class="menu__section__list__item__link">
                            <span class="menu__section__list__item__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 477.869 477.869">
                                    <g>
                                        <path d="M387.415,233.496c48.976-44.029,52.987-119.424,8.958-168.4C355.991,20.177,288.4,12.546,239.02,47.332 c-53.83-37.99-128.264-25.149-166.254,28.68c-34.859,49.393-27.259,117.054,17.689,157.483 c-55.849,29.44-90.706,87.481-90.453,150.613v51.2c0,9.426,7.641,17.067,17.067,17.067h443.733    c9.426,0,17.067-7.641,17.067-17.067v-51.2C478.121,320.976,443.264,262.935,387.415,233.496z M307.201,59.842c47.062-0.052,85.256,38.057,85.309,85.119c0.037,33.564-19.631,64.023-50.237,77.799c-1.314,0.597-2.628,1.143-3.959,1.707c-4.212,1.699-8.556,3.051-12.988,4.045c-0.853,0.188-1.707,0.29-2.577,0.461c-4.952,0.949-9.977,1.457-15.019,1.519c-2.27,0-4.557-0.171-6.827-0.375c-0.853,0-1.707,0-2.56-0.171c-9.7-1.142-19.136-3.923-27.904-8.226c-0.324-0.154-0.7-0.137-1.024-0.273c-1.707-0.819-3.413-1.536-4.932-2.458c0.137-0.171,0.222-0.358,0.358-0.529c7.826-10.056,13.996-21.296,18.278-33.297l0.529-1.434c1.947-5.732,3.459-11.602,4.523-17.562c0.154-0.87,0.273-1.707,0.41-2.645c0.987-6.067,1.506-12.2,1.553-18.347c-0.049-6.135-0.568-12.257-1.553-18.313c-0.137-0.887-0.256-1.707-0.41-2.645c-1.064-5.959-2.576-11.83-4.523-17.562l-0.529-1.434c-4.282-12.001-10.453-23.241-18.278-33.297c-0.137-0.171-0.222-0.358-0.358-0.529C277.449,63.831,292.19,59.843,307.201,59.842z M85.335,145.176c-0.121-47.006,37.886-85.21,84.892-85.331c22.034-0.057,43.232,8.434,59.134,23.686c0.99,0.956,1.963,1.911,2.918,2.901c2.931,3.071,5.634,6.351,8.09,9.813c0.751,1.058,1.434,2.185,2.133,3.277c2.385,3.671,4.479,7.523,6.263,11.52c0.427,0.973,0.751,1.963,1.126,2.935c1.799,4.421,3.215,8.989,4.233,13.653c0.12,0.512,0.154,1.024,0.256,1.553c2.162,10.597,2.162,21.522,0,32.119c-0.102,0.529-0.137,1.041-0.256,1.553c-1.017,4.664-2.433,9.232-4.233,13.653c-0.375,0.973-0.7,1.963-1.126,2.935c-1.786,3.991-3.88,7.837-6.263,11.503c-0.7,1.092-1.382,2.219-2.133,3.277c-2.455,3.463-5.159,6.742-8.09,9.813c-0.956,0.99-1.929,1.946-2.918,2.901c-6.91,6.585-14.877,11.962-23.569,15.906c-1.382,0.631-2.782,1.212-4.198,1.707c-4.114,1.633-8.347,2.945-12.663,3.925c-1.075,0.239-2.185,0.375-3.277,0.563c-4.634,0.863-9.333,1.336-14.046,1.417h-1.877c-4.713-0.08-9.412-0.554-14.046-1.417c-1.092-0.188-2.202-0.324-3.277-0.563c-4.316-0.98-8.55-2.292-12.663-3.925c-1.417-0.563-2.816-1.143-4.198-1.707C105.013,209.057,85.374,178.677,85.335,145.176z M307.201,418.242H34.135v-34.133c-0.25-57.833,36.188-109.468,90.76-128.614c29.296,12.197,62.249,12.197,91.546,0c5.698,2.082,11.251,4.539,16.623,7.356c3.55,1.826,6.827,3.908,10.24,6.007c2.219,1.382,4.471,2.731,6.605,4.25c3.294,2.338,6.4,4.881,9.455,7.492c1.963,1.707,3.908,3.413,5.751,5.12c2.816,2.662,5.461,5.478,8.004,8.363c1.826,2.082,3.601,4.198,5.291,6.383c2.236,2.867,4.369,5.803,6.349,8.823c1.707,2.56,3.226,5.222,4.727,7.885c1.707,2.935,3.277,5.871,4.71,8.926c1.434,3.055,2.697,6.4,3.925,9.66c1.075,2.833,2.219,5.649,3.106,8.533c1.195,3.959,2.031,8.055,2.867,12.151c0.512,2.423,1.178,4.796,1.553,7.253c1.011,6.757,1.53,13.579,1.553,20.412V418.242z M443.735,418.242h-102.4v-34.133c0-5.342-0.307-10.633-0.785-15.872c-0.137-1.536-0.375-3.055-0.546-4.591c-0.461-3.772-0.99-7.509-1.707-11.213c-0.307-1.581-0.631-3.169-0.973-4.762c-0.819-3.8-1.769-7.566-2.85-11.298c-0.358-1.229-0.683-2.475-1.058-3.686c-4.779-15.277-11.704-29.797-20.565-43.127l-0.666-0.973c-2.935-4.358-6.07-8.573-9.404-12.646l-0.119-0.154c-3.413-4.232-7.117-8.346-11.008-12.237c0.222,0,0.461,0,0.7,0c4.816,0.633,9.666,0.975,14.524,1.024h0.939c4.496-0.039,8.985-0.33,13.449-0.87c1.399-0.171,2.782-0.427,4.181-0.649c3.63-0.557,7.214-1.28,10.752-2.167c1.007-0.256,2.031-0.495,3.055-0.785c4.643-1.263,9.203-2.814,13.653-4.642c54.612,19.127,91.083,70.785,90.829,128.649V418.242z" fill="#2d3036" data-original="#000000" style="" class="" />
                                    </g>
                                </svg>
                            </span>
                            <span class="menu__section__list__item__text">Utilisateurs</span>
                        </a>
                    </li>
                </ul>
            </section>

            <section class="menu__section">
                <ul class="menu__section__list">
                    <!-- Paramètres -->
                    <li class="menu__section__list__item">
                        <a href="" class="menu__section__list__item__link">
                            <span class="menu__section__list__item__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="black" width="18px" height="18px">
                                    <g>
                                        <path d="M0,0h24v24H0V0z" fill="none" />
                                        <path d="M19.14,12.94c0.04-0.3,0.06-0.61,0.06-0.94c0-0.32-0.02-0.64-0.07-0.94l2.03-1.58c0.18-0.14,0.23-0.41,0.12-0.61 l-1.92-3.32c-0.12-0.22-0.37-0.29-0.59-0.22l-2.39,0.96c-0.5-0.38-1.03-0.7-1.62-0.94L14.4,2.81c-0.04-0.24-0.24-0.41-0.48-0.41 h-3.84c-0.24,0-0.43,0.17-0.47,0.41L9.25,5.35C8.66,5.59,8.12,5.92,7.63,6.29L5.24,5.33c-0.22-0.08-0.47,0-0.59,0.22L2.74,8.87 C2.62,9.08,2.66,9.34,2.86,9.48l2.03,1.58C4.84,11.36,4.8,11.69,4.8,12s0.02,0.64,0.07,0.94l-2.03,1.58 c-0.18,0.14-0.23,0.41-0.12,0.61l1.92,3.32c0.12,0.22,0.37,0.29,0.59,0.22l2.39-0.96c0.5,0.38,1.03,0.7,1.62,0.94l0.36,2.54 c0.05,0.24,0.24,0.41,0.48,0.41h3.84c0.24,0,0.44-0.17,0.47-0.41l0.36-2.54c0.59-0.24,1.13-0.56,1.62-0.94l2.39,0.96 c0.22,0.08,0.47,0,0.59-0.22l1.92-3.32c0.12-0.22,0.07-0.47-0.12-0.61L19.14,12.94z M12,15.6c-1.98,0-3.6-1.62-3.6-3.6 s1.62-3.6,3.6-3.6s3.6,1.62,3.6,3.6S13.98,15.6,12,15.6z" />
                                    </g>
                                </svg>
                            </span>
                            <span class="menu__section__list__item__text">Paramètres</span>
                        </a>
                    </li>
                </ul>
            </section>
            
            <small class="flex flex-col align-center text-muted">
                Icons from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a>
            </small>
        </aside>

        <main class="menu y-scroll-auto">
            <?php include $this->view; ?>
        </main>
    </div>
</body>
</html>