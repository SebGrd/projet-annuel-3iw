<div class="">
  <div class="flex justify-between align-center">
    <h2>Commandes</h2>
  </div>

    <?php $_TB::render(\App\Models\Order::class, ['user_id'], ['createdAt'=>'DESC']) ?>
</div>