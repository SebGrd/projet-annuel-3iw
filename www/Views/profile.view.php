<main class="auth">
	<div class="row h-full w-full">
		<div class="col-14 row bg-primary text-light flex flex-wrap flex-col justify-center">
			<h1 class="text-center text-light">Modification du profil</h1>
			<p class="text-center text-light">
				Modifiez votre profil en utilisant les informations qui vous conviennent..
			</p>
		</div>

		<div class="col-10 flex flex-col justify-center">
			<?php if (isset($user)) {
				extract((array) $user) ?>
				<section class="flex flex-col align-center">
					<div class="flex flex-col justify-center align-center w-100">
						<?php if ($user->avatar !== null) { ?>
							<img src=<?= 'http://' . $_SERVER['HTTP_HOST'] . '/' . \App\Core\Helpers::getImageUrl($user->avatar) ?> />
						<?php } ?>

						<!-- Show messages -->
						<?= $_::render('incl.message', ['msgs' => ['edit_profile_success', 'edit_profile_error'], 'errs' => $errors ?? []]); ?>

						<!-- Render form -->
						<?= $_FB::render($form); ?>

						<div class="flex flex-col w-100 align-center mt-1">
							<a href="/" class="col-12 btn btn-secondary auth__section__form__links__link">Retour à la page d'accueil</a>
						</div>
					</div>
				</section>
				<a href="/delete-my-account">Supprimer mon compte</a>
			<?php
			} else { ?>
				Aucune donnée à afficher
			<?php } ?>
		</div>
	</div>
</main>