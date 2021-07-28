<main class="auth y-scroll-auto">
    <div class="flex flex-xs-col flex-sm-row align-center w-100 h-full">
        <div class="col-sm-14 flex flex-col justify-center bg-primary text-light w-100 h-100">
            <h1 class="text-center text-light">Inscription</h1>
            <p class="text-center text-light">
                Inscrivez-vous afin d'accéder à nos services.
            </p>
        </div>

        <div class="col-sm-10 flex flex-col justify-center w-100 h-100">
            <section class="flex flex-col align-center">
                <div class="flex flex-col justify-center align-center w-100">
                    <h2>S'inscrire</h2>

                    <!-- Show messages -->
                    <?= $_::render('incl.message', ['msgs' => ['USER_EMAIL_ACTIVATED', 'register_error'], 'errs' => $errors ?? []]); ?>

                    <?= $_FB::render($form); ?>

                    <div class="flex align-center justify-around text-center btn-font w-100 mt-1 form__field">
                        <a href="/login" class="col btn btn-secondary auth__section__form__links__link">Se connecter</a>
                        <a href="/" class="col-12 btn btn-secondary auth__section__form__links__link">Retour à la page d'accueil</a>
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>
