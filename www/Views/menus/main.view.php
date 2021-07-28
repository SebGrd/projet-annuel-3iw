<div class="ml-1">
  <div class="flex justify-between align-center">
    <h2>Menus</h2>
    <a href="/admin/menu/new" class="btn btn-primary">Ajouter un menu</a>
  </div>

    <?php $_TB::render(\App\Models\Menu::class, ['image'], ['createdAt'=>'DESC']) ?>
</div>