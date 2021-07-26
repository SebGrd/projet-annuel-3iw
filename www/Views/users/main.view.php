<div class="">
  <div class="flex justify-between align-center">
    <h2>Utilisateurs</h2>
    <a href="/admin/user/new" class="btn btn-primary">Créer un nouvel utilisateur</a>
  </div>

    <?php $_TB::render(\App\Models\User::class, ['pwd', 'pwdResetToken', 'isDeleted'], ['createdAt'=>'DESC']) ?>
</div>