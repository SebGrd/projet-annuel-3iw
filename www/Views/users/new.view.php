<div class="admin_view">
	<section>
		<a href="/admin/users" class="btn btn-dark">Annuler</a>
		<h2>Créer un nouvel utilisateur</h2>
	</section>

	<!-- Show messages -->
	<?= $_::render('incl.message', ['msgs' => ['CREATE_USER_SUCCESS', 'CREATE_USER_ERROR'], 'errs' => $errors ?? []]); ?>

	<div class="row">
		<div class="col-md-6">
			<?php $_FB::render($form); ?>
		</div>
	</div>
</div>