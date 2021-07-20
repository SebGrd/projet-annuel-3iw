<div class="admin_view">
  <section>
    <h2>Modification du menu : <?= $menu->getTitle() ?></h2>
  </section>

  <div class="col-md-3">

    <!-- Show messages -->
  	<?= $_::render('incl.message', ['msgs' => ['edit_page_success', 'edit_page_error'], 'errs' => $errors ?? []]); ?>

    <?php if($menu->getImage() !== null): ?>
      <img src="../<?= App\Core\Helpers::getImageUrl($menu->getImage()) ?>" style="max-width: 100%; max-height: 150px;">
    <?php endif; ?>
    
    <?php $_FB::render($form); ?>
    <a type="button" href='/admin/menus'>Retour</a>
  </div>
</div>