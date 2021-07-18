<div class="container">
    <div class="flex justify-between align-center">
        <h2>Produits</h2>
        <a href="/admin/product/new" class="btn btn-primary">Ajouter un produit</a>
    </div>
    <?php echo($errors ?? '');?>
    <?php \App\Core\TableBuilder::render(\App\Models\Product::class, []) ?>
</div>