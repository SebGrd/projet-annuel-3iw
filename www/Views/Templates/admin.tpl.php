<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <?= $_::render('style'); ?> -->
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta name='description' content='cms restaurant'>
    <link rel="stylesheet" href="/public/style/boostrip.css">
    <link rel="stylesheet" href="/public/style/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="/public/script/script.js" defer></script>
    <title>Dashboard</title>
</head>
<body>
<header class="header" id="header">
    <section class="header__title">
        <a href="/admin">
            <h1>Dashboard</h1>
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
            <li class="header__menu__list__item header__menu__list__item--notifications ">
                <button class="header__menu__list__item--notifications__button">
                    <svg class="header__menu__list__item--notifications__button__icon"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="18px" height="18px">
                        <path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.89 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z"/>
                    </svg>
                </button>
            </li>
            <li class="header__menu__list__item header__menu__list__item--separator "></li>
            <li class="header__menu__list__item header__menu__list__item--profile ">
                <span class="header__menu__list__item--profile__name"><?= $_SESSION['userStore']->firstname ?></span>
                <figure class="header__menu__list__item--profile__picture" id="pp-button">
                    <img src="https://picsum.photos/100/100.jpg" alt="">
                </figure>
                <ul class="header__menu__popup-menu" id="pp-menu">
                    <li class="header__menu__popup-menu__item">
                        <a href="/admin/my-profile" class="header__menu__popup-menu__item__link">
                            Mon profil
                        </a>
                    </li>
                    <li class="header__menu__popup-menu__item">
                        <a href="/logout" class="header__menu__popup-menu__item__link header__menu__popup-menu__item__link--danger">
                            Déconnexion
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

    </section>
</header>
<div class="page-wrapper">
    <aside class="menu">
        <section class="menu__section">
            <span class="menu__section__title">Contenu</span>
            <ul class="menu__section__list">
                <li class="menu__section__list__item">
                    <a href="/admin/pages" class="menu__section__list__item__link">
                        <span class="menu__section__list__item__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="18px" height="18px">
                                <path d="M0 0h24v24H0z" fill="none"/><path d="M6 2c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6H6zm7 7V3.5L18.5 9H13z"/></svg>
                        </span>
                        <span class="menu__section__list__item__text">Pages</span>
                    </a>
                </li>
                <li class="menu__section__list__item">
                    <a href="/admin/products" class="menu__section__list__item__link">
                           <span class="menu__section__list__item__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="18px" height="18px"><path
                                d="M0 0h24v24H0z" fill="none"/><path
                                d="M18.06 22.99h1.66c.84 0 1.53-.64 1.63-1.46L23 5.05h-5V1h-1.97v4.05h-4.97l.3 2.34c1.71.47 3.31 1.32 4.27 2.26 1.44 1.42 2.43 2.89 2.43 5.29v8.05zM1 21.99V21h15.03v.99c0 .55-.45 1-1.01 1H2.01c-.56 0-1.01-.45-1.01-1zm15.03-7c0-8-15.03-8-15.03 0h15.03zM1.02 17h15v2h-15z"/></svg>
                </span>
                        <span class="menu__section__list__item__text">Produits</span>
                    </a>
                </li>
                <li class="menu__section__list__item">
                    <a href="/admin/menus" class="menu__section__list__item__link">
                              <span class="menu__section__list__item__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="18px" height="18px"><path
                                d="M0 0h24v24H0z" fill="none"/><path
                                d="M19 5v14H5V5h14m1.1-2H3.9c-.5 0-.9.4-.9.9v16.2c0 .4.4.9.9.9h16.2c.4 0 .9-.5.9-.9V3.9c0-.5-.5-.9-.9-.9zM11 7h6v2h-6V7zm0 4h6v2h-6v-2zm0 4h6v2h-6zM7 7h2v2H7zm0 4h2v2H7zm0 4h2v2H7z"/></svg>
                </span>
                        <span class="menu__section__list__item__text">Menus</span>
                    </a>
                </li>
            </ul>
        </section>
        <section class="menu__section">
            <span class="menu__section__title">Data</span>
            <ul class="menu__section__list">
                <li class="menu__section__list__item">
                    <a href="" class="menu__section__list__item__link">
                              <span class="menu__section__list__item__icon">
                   <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24"
                        fill="black" width="18px" height="18px"><g><rect fill="none" height="24" width="24"/></g><g><g><g><path
                                           d="M23,8c0,1.1-0.9,2-2,2c-0.18,0-0.35-0.02-0.51-0.07l-3.56,3.55C16.98,13.64,17,13.82,17,14c0,1.1-0.9,2-2,2s-2-0.9-2-2 c0-0.18,0.02-0.36,0.07-0.52l-2.55-2.55C10.36,10.98,10.18,11,10,11s-0.36-0.02-0.52-0.07l-4.55,4.56C4.98,15.65,5,15.82,5,16 c0,1.1-0.9,2-2,2s-2-0.9-2-2s0.9-2,2-2c0.18,0,0.35,0.02,0.51,0.07l4.56-4.55C8.02,9.36,8,9.18,8,9c0-1.1,0.9-2,2-2s2,0.9,2,2 c0,0.18-0.02,0.36-0.07,0.52l2.55,2.55C14.64,12.02,14.82,12,15,12s0.36,0.02,0.52,0.07l3.55-3.56C19.02,8.35,19,8.18,19,8 c0-1.1,0.9-2,2-2S23,6.9,23,8z"/></g></g></g></svg>
                </span>
                        <span class="menu__section__list__item__text">Statistics</span>
                    </a>
                </li>
                <li class="menu__section__list__item">
                    <a href="" class="menu__section__list__item__link">
                          <span class="menu__section__list__item__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="18px" height="18px"><path
                                d="M0 0h24v24H0V0z" fill="none"/><path
                                d="M10 10.02h5V21h-5zM17 21h3c1.1 0 2-.9 2-2v-9h-5v11zm3-18H5c-1.1 0-2 .9-2 2v3h19V5c0-1.1-.9-2-2-2zM3 19c0 1.1.9 2 2 2h3V10H3v9z"/></svg>
                </span>
                        <span class="menu__section__list__item__text">Tables</span>
                    </a>
                </li>
                <li class="menu__section__list__item">
                    <a href="" class="menu__section__list__item__link">
                            <span class="menu__section__list__item__icon">
                   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="18px" height="18px"><path
                               d="M0 0h24v24H0z" fill="none"/><path
                               d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/></svg>
                </span>
                        <span class="menu__section__list__item__text">Orders</span>
                    </a>
                </li>
            </ul>
        </section>
        <section class="menu__section menu__section--bottom">
            <ul class="menu__section__list">
                <li class="menu__section__list__item">
                    <a href="" class="menu__section__list__item__link">
                            <span class="menu__section__list__item__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24"
                         fill="black" width="18px" height="18px"><g><path d="M0,0h24v24H0V0z" fill="none"/><path
                                    d="M19.14,12.94c0.04-0.3,0.06-0.61,0.06-0.94c0-0.32-0.02-0.64-0.07-0.94l2.03-1.58c0.18-0.14,0.23-0.41,0.12-0.61 l-1.92-3.32c-0.12-0.22-0.37-0.29-0.59-0.22l-2.39,0.96c-0.5-0.38-1.03-0.7-1.62-0.94L14.4,2.81c-0.04-0.24-0.24-0.41-0.48-0.41 h-3.84c-0.24,0-0.43,0.17-0.47,0.41L9.25,5.35C8.66,5.59,8.12,5.92,7.63,6.29L5.24,5.33c-0.22-0.08-0.47,0-0.59,0.22L2.74,8.87 C2.62,9.08,2.66,9.34,2.86,9.48l2.03,1.58C4.84,11.36,4.8,11.69,4.8,12s0.02,0.64,0.07,0.94l-2.03,1.58 c-0.18,0.14-0.23,0.41-0.12,0.61l1.92,3.32c0.12,0.22,0.37,0.29,0.59,0.22l2.39-0.96c0.5,0.38,1.03,0.7,1.62,0.94l0.36,2.54 c0.05,0.24,0.24,0.41,0.48,0.41h3.84c0.24,0,0.44-0.17,0.47-0.41l0.36-2.54c0.59-0.24,1.13-0.56,1.62-0.94l2.39,0.96 c0.22,0.08,0.47,0,0.59-0.22l1.92-3.32c0.12-0.22,0.07-0.47-0.12-0.61L19.14,12.94z M12,15.6c-1.98,0-3.6-1.62-3.6-3.6 s1.62-3.6,3.6-3.6s3.6,1.62,3.6,3.6S13.98,15.6,12,15.6z"/></g></svg>
                </span>
                        <span class="menu__section__list__item__text">Settings</span>
                    </a>
                </li>
            </ul>
        </section>
    </aside>
    <main>
        <?php include $this->view ;?>
        <!-- <?php var_dump($_SESSION['userStore']);?> -->
    </main>
</div>
</body>
</html>