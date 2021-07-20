<div class="container" id="page-builder">
    <h2>Edit page <?= $page->getTitle()?></h2>
    <a href="/admin/pages" class="btn btn-dark">Return without saving</a>
    
    <!-- Show messages -->
	<?= $_::render('incl.message', ['msgs' => ['edit_page_success', 'edit_page_error'], 'errs' => $errors ?? []]); ?>
    
    <div class="row">
        <div class="col-18">
            <h3>Page builder</h3>
            <div class="page-builder">
                <div id="editor">
                  <?= $page->getHTML()?>
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