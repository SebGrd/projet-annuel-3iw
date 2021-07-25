const ppBtns = document.getElementsByClassName('pp-btn');
const ppMenus = document.getElementsByClassName('pp-menu');

// Array.prototype.forEach.call(ppBtns, function(ppBtn) {
//     // For each pp-btn, add a click event handler and toggle the class 'active' on its data-pp-menu attribute
//     ppBtn.addEventListener('click', () => {
//         const ppMenu = document.getElementById(ppBtn.getAttribute('data-pp-menu'));
//         ppMenu.classList.toggle('hidden');

//         setTimeout(() => {
//             ppMenu.classList.toggle('hidden');
//         }, 1000);
//     });
// });

// ppButton.addEventListener('click', (e) => {
//     ppMenu.classList.toggle('header__menu__popup-menu--active')
// })

if (document.getElementById('page-builder')){
    const quill = new Quill('#editor', {
        theme: 'snow'
    });
    quill.on('text-change', function() {
        document.getElementById('html').value = quill.root.innerHTML;
    });
}

$('.datatable').DataTable();
