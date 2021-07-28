<div class="ml-1">
    <div class="flex justify-between align-center">
        <h2>Pages</h2>
        <a href="/admin/page/new" class="btn btn-primary">Créer une page</a>
    </div>
    <?php $_TB::render(\App\Models\Page::class, ['html', 'image']) ?>
</div>