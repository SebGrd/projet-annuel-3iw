<div class="ml-1">
  <div class="flex justify-between align-center">
    <h2>Catégories</h2>
    <a href="/admin/menu/new" class="btn btn-primary">Ajouter une catégorie</a>
  </div>
    <!-- Show messages -->
    <?= $_::render('incl.message', ['msgs' => ['DELETE_MENU_SUCCESS', 'DELETE_MENU_ERROR'], 'errs' => $errors ?? []]); ?>

    <?php $_TB::render(\App\Models\Menu::class, ['image'], ['createdAt'=>'DESC']) ?>
</div>