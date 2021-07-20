<?php if (isset($user)) { extract((array) $user) ?>
	<section class="">
		<h3>Profil de <?= $firstname ?> <?= $lastname ?></h3>

		<!-- Show messages -->
		<?= $_::render('incl.message', ['msgs' => ['edit_profile_success', 'edit_profile_error'], 'errs' => $errors ?? []]); ?>

		<!-- Render form -->
		<?= $_FB::render($form); ?>
	</section>
<?php } else { ?>
	No data:
<?php } ?>