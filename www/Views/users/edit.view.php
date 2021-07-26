<div class="admin_view">
	<section>
		<a href="/admin/users" class="btn btn-dark">Annuler</a>
		<h2>Modification de l'utilisateur "<?= $user->getFirstname() ?>"</h2>
	</section>

	<div class="col-md-3">
		<!-- Show messages -->
		<?= $_::render('incl.message', ['msgs' => ['EDIT_USER_SUCCESS', 'EDIT_USER_ERROR'], 'errs' => $errors ?? []]); ?>

		<?php if($user->getAvatar() !== null): ?>
			<img src="../<?= $_::getImageUrl($user->getAvatar()) ?>" style="max-width: 100%; max-height: 150px;">
		<?php endif; ?>
		
		<?php $_FB::render($form); ?>
	</div>
</div>