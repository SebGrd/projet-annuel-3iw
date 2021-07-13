<div class="container">
    <div class="flex justify-between align-center">
        <h2>Pages</h2>
        <a href="/admin/pages/new" class="btn btn-primary">Créer une page</a>
    </div>
    <?php echo($errors ?? '');?>
    <?php \App\Core\TableBuilder::render(\App\Models\Page::class, ['html', 'image']) ?>
</div>