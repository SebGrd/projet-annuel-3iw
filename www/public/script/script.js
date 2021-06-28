const ppButton = document.getElementById('pp-button');
const ppMenu = document.getElementById('pp-menu');

ppButton.addEventListener('click', (e) => {
    ppMenu.classList.toggle('header__menu__popup-menu--active')
})