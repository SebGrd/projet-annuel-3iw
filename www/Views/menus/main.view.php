<div class="">
  <div class="flex justify-between align-center">
    <h2>Catégories</h2>
    <a href="/admin/menu/new" class="btn btn-primary">Ajouter une catégorie</a>
  </div>

    <?php $_TB::render(\App\Models\Menu::class, ['image'], ['createdAt'=>'DESC']) ?>
</div>