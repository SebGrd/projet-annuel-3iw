<div id="page-builder">
	<section>
		<a href="/admin/pages" class="btn btn-dark">Annuler</a>
		<h2>Créer une nouvelle page</h2>
	</section>

	<!-- Show messages -->
	<?= $_::render('incl.message', ['msgs' => ['NEW_PAGE_SUCCESS', 'NEW_PAGE_ERROR'], 'errs' => $errors ?? []]); ?>

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