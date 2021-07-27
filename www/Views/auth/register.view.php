<main class="auth">
    <div class="row h-full w-full">
        <div class="col-14 row bg-primary text-light flex flex-wrap flex-col justify-center">
            <h1 class="text-center text-light">Inscription</h1>
            <p class="text-center text-light">
                Inscrivez-vous afin d'accéder à nos services.
            </p>
        </div>

        <div class="col-10 flex flex-col justify-center">
            <section class="flex flex-col align-center">
                <div class="flex flex-col justify-center align-center w-100">
                    <h2>S'inscrire</h2>

                    <!-- Show messages -->
                    <?= $_::render('incl.message', ['msgs' => ['USER_EMAIL_ACTIVATED', 'register_error'], 'errs' => $errors ?? []]); ?>

                    <?= $_FB::render($form); ?>

                    <div class="flex flex-col w-100 align-center mt-1">
                        <a href="/login" class="col auth__section__form__link">Se connecter</a>
                    </div>

                    <div class="flex flex-col w-100 align-center mt-1">
                        <a href="/" class="col-12 btn btn-secondary auth__section__form__links__link">Retour à la page d'accueil</a>
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>
