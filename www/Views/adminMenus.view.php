<div class="">
  <div class="flex justify-between align-center">
    <h2>Menus</h2>
    <a href="/admin/menu/new" class="btn btn-primary">Ajouter un menu</a>
  </div>

    <?php \App\Core\TableBuilder::render(\App\Models\Menu::class, ['image']) ?>
</div>