<div class="container" id="page-builder">
    <h2>Nouveau produit</h2>
    <a href="/admin/products" class="btn btn-dark">Annuler</a>
    </br>
    </br>
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
    <div class="row">
        <div class="col-6">
            <?php App\Core\FormBuilder::render($form); ?>
        </div>
    </div>
</div>