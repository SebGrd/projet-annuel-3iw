<div class="container" id="page-builder">
	<section>
		<a href="/admin/products" class="btn btn-dark">Annuler</a>
		<h2>Créer un nouveau produit</h2>
	</section>
	
	<!-- Show messages -->
	<?= $_::render('incl.message', ['msgs' => ['edit_page_success', 'edit_page_error'], 'errs' => $errors ?? []]); ?>

	<div class="row">
		<div class="col-6">
			<?php $_FB::render($form); ?>
		</div>
	</div>
</div>