<main class="admin_view">
  <section>
    <h2>Gestion des menus</h2>
  </section>
  <div class="table_container">
      <table class="dt_table" aria-label="Pages">
          <thead>
          <tr class="dt_header">
              <th class="dt_header-cell" role="columnheader" scope="col">Nom</th>
              <th class="dt_header-cell" role="columnheader" scope="col">Description</th>
              <th class="dt_header-cell" role="columnheader" scope="col">Image</th>
              <th class="dt_header-cell" role="columnheader" scope="col">Actif</th>
              <th class="dt_header-cell" role="columnheader" scope="col">Actions</th>
          </tr>
          </thead>
          <tbody class="dt_content">
          <?php if (isset($menus)): ?>
            <tbody>
              <?php foreach ($menus as $menu=>$m): ?>
                <tr class="dt_row">
                  <td class="dt_header-cell"><?= $m->getTitle(); ?></td>
                  <td class="dt_header-cell"><?= $m->getDescription(); ?></td>
                  <td class="dt_header-cell">
                    <image src="<?= $m->getImage(); ?>" />
                  </td>
                  <td class="dt_header-cell dt_header-cell--center">
                    <input disabled type="checkbox" id="scales" name="scales" <?= $m->getActive() ? 'checked' : '' ?> />
                  </td>
                  <td class="dt_header-cell">
                  <button class="" type="button" onclick="window.location.href='/admin/menus/edit?id=<?= $m->getId()?>'">
                      Editer
                  </button>
                  <button class="" type="button" onclick="window.location.href='/admin/menus/delete?id=<?= $m->getId()?>'">
                      Supprimer
                  </button>
                  </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          <?php endif; ?>
          </tbody>
      </table>
  </div>
  <br>
  <br>
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
  </div>
</main>