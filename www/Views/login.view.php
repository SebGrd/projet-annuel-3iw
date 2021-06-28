<main class="auth">
    <div class="row">
        <div class="col-14 bg-primary"></div>
        <div class="col-10">
            <section class="auth__section">
                <div class="auth__section__form">
                    <h2>Se connecter</h2>
                    <?php $_FB::render($form); ?>
                                    
                    <?php if (isset($errors)): ?>
                        <ul class="auth__section__form__list">
                            <?php foreach ($errors as $error): ?>
                                <li style="color: red;">
                                    <?= $error; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <a href="/register" class="auth__section__form__link">S'inscrire</a>
                    <a href="/forgot-password" class="auth__section__form__link">Mot de passe oublié</a>
                </div>
            </section>
        </div>
    </div>
</main>

