if (document.getElementById('page-builder')){
    const quill = new Quill('#editor', {
        theme: 'snow'
    });
    quill.on('text-change', function() {
        document.getElementById('html').value = quill.root.innerHTML;
    });
}

$('.datatable').DataTable();