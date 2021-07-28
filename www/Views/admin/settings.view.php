<main class="auth y-scroll-auto">
    <div class="flex flex-xs-col flex-sm-row align-center w-100 h-full">
        <div class="col-sm-14 flex flex-col justify-center bg-primary text-light w-100 h-100">
			<h1 class="text-center text-light">Paramètres</h1>
			<p class="text-center text-light">
				Modifiez les paramètres de votre site.
			</p>
		</div>

		<div class="col-sm-10 flex flex-col justify-center w-100 h-100">
			<?php if (isset($user)) {
				extract((array) $user) ?>
				<section class="flex flex-col align-center">
					<div class="flex flex-col justify-center align-center w-100">
						<h2 class="text-center">Paramètres</h2>

						<!-- Show messages -->
						<?= $_::render('incl.message', ['msgs' => ['EDIT_SETTINGS_SUCCESS', 'EDIT_SETTINGS_ERROR'], 'errs' => $errors ?? []]); ?>

						<!-- Render form -->
						<?= $_FB::render($forms); ?>
					
						<div class="flex align-center justify-around text-center btn-font w-100 mt-1 form__field">
							<a href="/" class="col-11 btn btn-secondary">Retour</a>
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
