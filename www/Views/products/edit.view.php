<div class="admin_view">
	<section>
		<a href="/admin/products" class="btn btn-dark">Annuler</a>
		<h2>Modification du produit "<?= $product->getName() ?>"</h2>
	</section>
	
	<!-- Show messages -->
	<?= $_::render('incl.message', ['msgs' => ['edit_product_success', 'edit_product_error'], 'errs' => $errors ?? []]); ?>

	<?php if($product->getImage() !== null): ?>
		<img src="../<?= $_::getImageUrl($product->getImage()) ?>" style="max-width: 100%; max-height: 150px;">
	<?php endif; ?>

	<?php $_FB::render($form); ?>
</div>