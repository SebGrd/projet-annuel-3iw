<div id="page-builder">
    <h2>Nouvelle page</h2>
    <div>
        <a href="/admin/pages" class="btn btn-dark">Retour</a>
    </div>

    <!-- Show messages -->
	<?= $_::render('incl.message', ['msgs' => ['PAGE_SUCCESS', 'PAGE_ERROR'], 'errs' => $errors ?? []]); ?>

    <div class="row">
        <div class="col-18">
            <h3>Editeur de page</h3>
            <div class="page-builder">
                <div id="editor"></div>
            </div>
        </div>
        <div class="col-6 flex">
            <div>
                <?php $_FB::render($pageForm); ?>
            </div>
        </div>

    </div>
</div>