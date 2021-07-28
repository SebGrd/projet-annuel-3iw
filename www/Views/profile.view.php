<main class="auth y-scroll-auto">
    <div class="flex flex-xs-col flex-sm-row align-center w-100 h-full">
        <div class="col-sm-14 flex flex-col justify-center bg-primary text-light w-100 h-100">
			<h1 class="text-center text-light">Modification du profil</h1>
			<p class="text-center text-light">
				Modifiez votre profil en utilisant les informations qui vous conviennent.
			</p>
		</div>

		<div class="col-sm-10 flex flex-col justify-center w-100 h-100">
			<?php if (isset($user)) {
				extract((array) $user) ?>
				<section class="flex flex-col align-center">
					<div class="flex flex-col justify-center align-center w-100">
						<?php if ($user->getAvatar() !== null) { ?>
							<img class="brd-50 w-30" src=<?= 'http://' . $_SERVER['HTTP_HOST'] . '/' . $_::getImageUrl($user->getAvatar()) ?> />
						<?php } ?>

						<!-- Show messages -->
						<?= $_::render('incl.message', ['msgs' => ['EDIT_PROFILE_SUCCESS', 'EDIT_PROFILE_ERROR'], 'errs' => $errors ?? []]); ?>

						<!-- Render form -->
						<?= $_FB::render($form); ?>
					
						<div class="flex align-center justify-around text-center btn-font w-100 mt-1 form__field">
							<a href="/" class="col-11 btn btn-secondary">Retour</a>
							<a href="/delete-my-account" class="col-11 btn btn-danger">Supprimer mon compte</a>
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
