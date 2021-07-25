<div class="container" id="page-builder">
	<section>
		<a href="/admin/pages" class="btn btn-dark">Annuler</a>
		<h2>Modification de la page "<?= $page->getTitle()?>"</h2>
	</section>
	
	<div class="row">
		<div class="col-18">
			<h3>Page builder</h3>
			<div class="page-builder">
				<div id="editor">
				  <?= html_entity_decode($page->getHTML()); ?>
				</div>
			</div>
		</div>
		<div class="col-6">
			<!-- Show messages -->
			<?= $_::render('incl.message', ['msgs' => ['edit_page_success', 'edit_page_error'], 'errs' => $errors ?? []]); ?>

			<?php if ($page->getImage() !== null): ?>
				<img src="../<?= $_::getImageUrl($page->getImage()) ?>" style="max-width: 100%; max-height: 150px;">
			<?php endif; ?>

			<?php $_FB::render($form); ?>
		</div>
	</div>
</div>