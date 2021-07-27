<main class="auth">
    <div class="row h-full w-full">
        <div class="col-14 row bg-primary text-light flex flex-wrap flex-col justify-center">
            <h1 class="text-center text-light">Réinitialiser votre mot de passe</h1>
            <p class="text-center text-light">
                Entrez votre email, pour reçevoir un lien de réinitialisation.
            </p>
        </div>
        
        <div class="col-10 flex flex-col justify-center">
            <section class="flex flex-col align-center">
                <div class="flex flex-col justify-center">
                    <h2>Mot de passe oublié</h2>

                    <!-- Show messages -->
                    <?= $_::render('incl.message', ['msgs' => [], 'errs' => $errors ?? []]); ?>
					
										<?= $_FB::render($formResetPassword ?? $formNewPassword); ?>

                    <div class="auth__section__form__links">
                        <a href="/login" class="auth__section__form__links__link">Se connecter</a>
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>
