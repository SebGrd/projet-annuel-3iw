<main class="auth">
    <div class="row">
        <div class="col-14 bg-primary"></div>
        <div class="col-10">
            <section class="auth__section">
                <div class="auth__section__form">
                    <h2>Se connecter</h2>

                    <!-- Show messages -->
                    <?= $_::render('incl.message', ['msgs' => ['register_success', 'login_error'], 'errs' => $errors ?? []]); ?>

                    <?= $_FB::render($form); ?>

                    <div class="auth__section__form__links">
                        <a href="/register" class="auth__section__form__links__link">S'inscrire</a>
                        <a href="/forgot-password" class="auth__section__form__links__link">Mot de passe oublié</a>
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>

