<?php if (isset($user)) { extract((array) $user) ?>
	<section class="">
		<h3>Mon profil</h3>
		<?php if ($user->avatar !== null) { ?>
			<img src=<?= 'http://' . $_SERVER['HTTP_HOST'] . '/'. \App\Core\Helpers::getImageUrl($user->avatar) ?> />
		<?php } ?>

		<!-- Show messages -->
		<?= $_::render('incl.message', ['msgs' => ['edit_profile_success', 'edit_profile_error'], 'errs' => $errors ?? []]); ?>

		<!-- Render form -->
		<?= $_FB::render($form); ?>
	</section>
	<a href="/delete-my-account" >Supprimer mon compte</a>
<?php } else { ?>
	No data:
<?php } ?>