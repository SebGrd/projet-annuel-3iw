<div class="admin_view">
	<section>
		<a href="/admin/menus" class="btn btn-dark">Annuler</a>
		<h2>Créer un nouveau menu</h2>
	</section>

	<!-- Show messages -->
	<?= $_::render('incl.message', ['msgs' => ['menu_success', 'menu_error'], 'errs' => $errors ?? []]); ?>

	<div class="row">
		<div class="col-md-3">
			<?php $_FB::render($form); ?>
		</div>
	</div>
</div>