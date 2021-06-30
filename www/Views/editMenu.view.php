<main class="admin_view">
  <section>
    <h2>Edition du menu : <?= $menu->getTitle() ?></h2>
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
    <button type="button" onclick="window.location.href='/admin/menus'">Retour</button>
  </div>
</main>