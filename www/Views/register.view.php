<main class="auth">
    <div class="row">
        <div class="col-14 bg-primary"></div>
        <div class="col-10">
            <section class="auth__section">
                <div class="auth__section__form">
                    <h2>S'inscrire</h2>
                    <ul class="auth__section__form__list">
                        <?php if (isset($success)): ?>
                            <li style="color: green;">
                                <?=$success; ?>
                            </li>
                        <?php endif; ?>
                        <?php if (isset($errors)): ?>
                            <?php foreach ($errors as $error): ?>
                                <li style="color: red;">
                                    <?=$error; ?>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                    <?php App\Core\FormBuilder::render($form); ?>
                    <a href="/login" class="auth__section__form__link">Se connecter</a>
                </div>
            </section>
        </div>
    </div>
</main>
