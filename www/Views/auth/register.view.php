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
                <div class="flex flex-col justify-center">
                    <h2>S'inscrire</h2>

                    <!-- Show messages -->
                    <?= $_::render('incl.message', ['msgs' => ['register_error'], 'errs' => $errors ?? []]); ?>

                    <?= $_FB::render($form); ?>
                    <a href="/login" class="auth__section__form__link">Se connecter</a>
                </div>
            </section>
        </div>
    </div>
</main>
