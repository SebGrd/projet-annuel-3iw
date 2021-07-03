const ppButton = document.getElementById('pp-button');
const ppMenu = document.getElementById('pp-menu');

ppButton.addEventListener('click', (e) => {
    ppMenu.classList.toggle('header__menu__popup-menu--active')
})

if (document.getElementById('page-builder')){
    const quill = new Quill('#editor', {
        theme: 'snow'
    });
    quill.on('text-change', function() {
        document.getElementById('html').value = quill.root.innerHTML;
    });
}

$('.datatable').DataTable();

