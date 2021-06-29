<main class="auth">
    <div class="row">
        <div class="col-14 bg-primary"></div>
        <div class="col-10">
            <section class="auth__section">
                <div class="auth__section__form">
                    <h2>Mot de passe oublié</h2>

                    <?php if (isset($success)): ?>
                        <ul class="auth__section__form__list">
                            <li style="color: green;">
                                <?= $success; ?>
                            </li>
                        </ul>
                    <?php endif; ?>
                    <?php if (isset($errors)): ?>
                        <?php foreach ($errors as $error): ?>
                            <ul class="auth__section__form__list">
                                <li style="color: red;">
                                    <?= $error; ?>
                                </li>
                            </ul>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php App\Core\FormBuilder::render($formResetPassword ?? $formNewPassword); ?>

                </div>
            </section>
        </div>
    </div>
</main>


