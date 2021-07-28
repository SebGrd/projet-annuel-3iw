<main class="auth y-scroll-auto">
    <div class="flex flex-xs-col flex-sm-row align-center w-100 h-full">
        <div class="col-sm-14 flex flex-col justify-center bg-primary text-light w-100 h-100">
            <h1 class="text-center text-light">Connexion</h1>
            <p class="text-center text-light">
                Connectez-vous à votre compte pour accéder à votre espace personnel.
            </p>
        </div>
        
        <div class="col-sm-10 flex flex-col justify-center w-100 h-100">
            <section class="flex flex-col align-center">
                <div class="flex flex-col justify-center align-center w-100">
                    <h2 class="text-center">Se connecter</h2>

                    <!-- Show messages -->
                    <?= $_::render('incl.message', ['msgs' => ['USER_VALIDATE_ACCOUNT_ERROR', 'REGISTER_SUCCESS', 'LOGIN_ERROR'], 'errs' => $errors ?? []]); ?>

                    <?= $_FB::render($form) ?>

                    <div class="flex align-center justify-around text-center btn-font w-100 mt-1 form__field">
                        <a href="/register" class="col-8 btn btn-secondary">S'inscrire</a>
                        <a href="/forgot-password" class="col-10 btn btn-warning">Mot de passe oublié</a>
                    </div>

                   <div class="flex align-center justify-around text-center btn-font w-100 mt-1 form__field">
                        <a href="/" class="col btn btn-secondary w-90">Retour</a>
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>
