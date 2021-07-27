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
							<img class="brd-50 w-30" src=<?= 'http://' . $_SERVER['HTTP_HOST'] . '/' . \App\Core\Helpers::getImageUrl($user->avatar) ?> />
						<?php } ?>

						<!-- Show messages -->
						<?= $_::render('incl.message', ['msgs' => ['edit_profile_success', 'edit_profile_error'], 'errs' => $errors ?? []]); ?>

						<!-- Render form -->
						<?= $_FB::render($form); ?>
						</br>
						</br>
						<div class="flex flex-row w-50 align-center mt-1 justify-between form__field">
							<a href="/" class="col-11 btn btn-secondary text-center btn-font">Retour</a>
							<a href="/delete-my-account" class="col-11 btn btn-danger text-center btn-font">Supprimer mon compte</a>
						</div>
					</div>
				</section>
			<?php
			} else { ?>
				Aucune donnée à afficher
			<?php } ?>
		</div>
	</div>
</main>
