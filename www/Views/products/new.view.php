<div id="page-builder">
	<section>
		<a href="/admin/products" class="btn btn-dark">Annuler</a>
		<h2>Créer un nouveau produit</h2>
	</section>
	
	<!-- Show messages -->
	<?= $_::render('incl.message', ['msgs' => ['NEW_PRODUCT_SUCCESS', 'NEW_PRODUCT_ERROR'], 'errs' => $errors ?? []]); ?>

	<div class="row">
		<div class="col-6">
			<?php $_FB::render($form); ?>
		</div>
	</div>
</div>