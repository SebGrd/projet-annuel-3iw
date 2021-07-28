<main class="auth y-scroll-auto">
    <div class="flex flex-xs-col flex-sm-row align-center w-100 h-full">
        <div class="col-sm-14 flex flex-col justify-center bg-primary text-light w-100 h-100">
            <h1 class="text-center text-light">Réinitialiser votre mot de passe</h1>
            <p class="text-center text-light">
                Entrez votre email pour recevoir un lien de réinitialisation.
            </p>
        </div>
        
        <div class="col-sm-10 flex flex-col justify-center w-100 h-100">
            <section class="flex flex-col align-center">
                <div class="flex flex-col justify-center align-center w-100">
                    <h2 class="text-center">Mot de passe oublié</h2>

                    <!-- Show messages -->
                    <?= $_::render('incl.message', ['msgs' => ['RESET_PASSWORD_SUCCESS', 'RESET_PASSWORD_ERROR'], 'errs' => $errors ?? []]); ?>

                    <?php if (!$emailSent) { ?>
					
                        <?= $_FB::render($formResetPassword ?? $formNewPassword); ?>

                        <div class="flex align-center justify-around text-center btn-font w-100 mt-1 form__field">
                            <a href="/login" class="col-12 btn btn-secondary">Se connecter</a>
                        </div>
                    <?php } else { ?>
                        <div class="btn-font">Vous pouvez fermer cette page.</div>
                    <?php } ?>
                </div>
            </section>
        </div>
    </div>
</main>
