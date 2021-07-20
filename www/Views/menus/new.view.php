<div class="admin_view">
  <section>
    <h2>Créer un menu</h2>
  </section>

  <div class="col-md-3">
    <?php if (isset($success)): ?>
      <li style="color: green;">
        <?= $success; ?>
      </li>
    <?php endif; ?>
    <?php if (isset($errors)): ?>
      <ul class="auth__section__form__list">
        <?php foreach ($errors as $error): ?>
          <li style="color: red;">
            <?= $error; ?>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>

    <?php App\Core\FormBuilder::render($form); ?>
    <a type="button" href='/admin/menus'>Retour</a>
  </div>
</div>