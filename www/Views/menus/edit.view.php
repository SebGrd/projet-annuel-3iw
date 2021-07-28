<div class="ml-1 admin_view">
	<section>
		<a href="/admin/menus" class="btn btn-dark">Annuler</a>
		<h2>Modification de la catégorie "<?= $menu->getTitle() ?>"</h2>
	</section>

	<!-- Show messages -->
	<?= $_::render('incl.message', ['msgs' => ['EDIT_MENU_SUCCESS', 'EDIT_MENU_ERROR'], 'errs' => $errors ?? []]); ?>

	<?php if($menu->getImage() !== null): ?>
		<img src="../<?= $_::getImageUrl($menu->getImage()) ?>" style="max-width: 100%; max-height: 150px;">
	<?php endif; ?>
	
	<?php $_FB::render($form); ?>
</div>