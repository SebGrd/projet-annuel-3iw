<main class="auth">
    <div class="row">
        <div class="col-14 bg-primary"></div>
        <div class="col-10">
            <section class="auth__section">
                <div class="auth__section__form">
                    <h2>Se connecter</h2>
                    <?php App\Core\FormBuilder::render($formLogin); ?>
                    <ul class="auth__section__form__list">
                        <?php if (isset($errors)): ?>
                            <?php foreach ($errors as $error): ?>
                                <li style="color: red;">
                                    <?=$error; ?>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                    <a href="/register" class="auth__section__form__link">S'inscrire</a>
                </div>
            </section>
        </div>
    </div>
</main>

