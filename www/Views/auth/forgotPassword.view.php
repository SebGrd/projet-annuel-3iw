<main class="auth">
	<div class="row">
		<div class="col-14 bg-primary"></div>
		<div class="col-10">
			<section class="auth__section">
				<div class="auth__section__form">
					<h2>Mot de passe oublié</h2>

					<!-- Show messages -->
                    <?= $_::render('incl.message', ['msgs' => [], 'errs' => $errors ?? []]); ?>
					
					<?= $_FB::render($formResetPassword ?? $formNewPassword); ?>
				</div>
			</section>
		</div>
	</div>
</main>