<main class="auth">
    <div class="row">
        <div class="col-14 bg-primary"></div>
        <div class="col-10">
            <section class="auth__section">
                <div class="auth__section__form">
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
