<div id="page-builder">
    <section>
    <h2>Modification de la page <?= $page->getTitle()?></h2>
    <div>
        <a href="/admin/pages" class="btn btn-dark">Retour</a>
    </div>
    
    <!-- Show messages -->
	<?= $_::render('incl.message', ['msgs' => ['EDIT_PAGE_SUCCESS', 'EDIT_PAGE_ERROR'], 'errs' => $errors ?? []]); ?>
    
    <div class="row">
        <div class="col-18">
            <h3>Editeur de page</h3>
            <div class="page-builder">
                <div id="editor">
                  <?= html_entity_decode($page->getHTML()) ?>
                </div>
            </div>
        </div>
        <div class="col-6">
            <?php if ($page->getImage() !== null): ?>
                <img src="../<?= $_::getImageUrl($page->getImage()) ?>" style="max-width: 100%; max-height: 150px;">
            <?php endif; ?>

			<?php $_FB::render($form); ?>
		</div>
	</div>
</div>