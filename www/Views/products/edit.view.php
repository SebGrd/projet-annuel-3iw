<div class="ml-1 admin_view">
	<section>
		<a href="/admin/products" class="btn btn-dark">Annuler</a>
		<h2>Modification du produit "<?= $product->getName() ?>"</h2>
		
		<!-- Show messages -->
		<?= $_::render('incl.message', ['msgs' => ['EDIT_PRODUCT_SUCCESS', 'EDIT_PRODUCT_ERROR'], 'errs' => $errors ?? []]); ?>

		<?php if($product->getImage() !== null): ?>
			<img src="../<?= $_::getImageUrl($product->getImage()) ?>" style="max-width: 100%; max-height: 150px;">
		<?php endif; ?>

		</br>
		</br>

        <?php $_FB::render($form); ?>
        <?php $_FB::render($formMenu); ?>
	</section>
</div>